<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\orders_details;
use App\Models\customers;
use App\Models\products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use FPDF;
require_once app_path('Libraries/FPDF/fpdf.php');

class orderController extends Controller
{
    public function index()
    {
        $orders = orders::with('orderDetails.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += ($item['price'] * $item['quantity']);
        }

        $shippingCost = 10000;
        $grandTotal = $totalPrice + $shippingCost;

        $customer = Auth::guard('customer')->user();

        return view('public.checkout', compact('cart', 'customer', 'totalPrice', 'shippingCost', 'grandTotal'));
    }

    public function cancel(orders $order)
    {
        if ($order->status == 'menunggu') {
            $order->status = 'dibatalkan';
            $order->save();

            return response()->json(['message' => 'Status pesanan sudah diubah menjadi dibatalkan']);
        }

        return response()->json(['message' => 'Tidak dapat membatalkan pesanan dengan status ini'], 400);
    }

    public function complete($id)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['message' => 'Silakan login terlebih dahulu'], 401);
        }
        
        $customerId = Auth::guard('customer')->user()->customer_id;
        
        $order = orders::where('order_id', $id)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        if ($order->status == 'dikirim') {
            $order->status = 'selesai';
            $order->save();

            return response()->json(['message' => 'Pesanan telah dikonfirmasi sebagai selesai']);
        }

        return response()->json(['message' => 'Tidak dapat mengkonfirmasi pesanan dengan status ini'], 400);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'receiver_name' => 'required|string|max:100',
            'order_date' => 'required|date',
            'payment_method' => 'required|string|in:cod,gateway',
            'total_price' => 'required|numeric|min:0',
            'shipping_cost' => 'required|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
            'receiver_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string', // DIHAPUS min:30
            'customer_note' => 'nullable|string',
            'order_details' => 'required|array|min:1',
            'order_details.*.product_id' => 'required|exists:products,product_id',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.price' => 'required|numeric|min:0',
        ], [
            'shipping_address.required' => 'Alamat pengiriman wajib diisi',
            // DIHAPUS: 'shipping_address.min' => 'Alamat pengiriman minimal 30 karakter',
        ]);

        // Validasi payment_method
        if (!in_array($validated['payment_method'], ['cod', 'gateway'])) {
            return redirect()->back()->with('error', 'Metode pembayaran tidak valid. Pilih cod atau gateway.')->withInput();
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // LOGIKA: Set status berdasarkan payment method
            $status = 'menunggu'; // default untuk gateway
            if ($validated['payment_method'] == 'cod') {
                $status = 'diproses'; // COD langsung diproses
            }

            // Simpan data order
            $order = orders::create([
                'customer_id' => $validated['customer_id'],
                'receiver_name' => $validated['receiver_name'],
                'order_date' => $validated['order_date'],
                'status' => $status, // Pakai status yang sudah ditentukan
                'payment_method' => $validated['payment_method'],
                'total_price' => $validated['total_price'],
                'shipping_cost' => $validated['shipping_cost'],
                'grand_total' => $validated['grand_total'],
                'receiver_phone' => $validated['receiver_phone'],
                'shipping_address' => $validated['shipping_address'],
                'customer_note' => $validated['customer_note'] ?? null,
            ]);

            // Simpan detail pesanan dengan DOUBLE CHECK quantity dari session cart
            $cart = session('cart', []);
            
            foreach ($validated['order_details'] as $detail) {
                // CEK: Validasi agar tidak ada produk duplikat
                static $processedProducts = [];
                if (in_array($detail['product_id'], $processedProducts)) {
                    throw new Exception('Produk duplikat ditemukan: ' . $detail['product_id']);
                }
                $processedProducts[] = $detail['product_id'];

                // Ambil quantity dari session cart sebagai sumber kebenaran
                $cartQuantity = $cart[$detail['product_id']]['quantity'] ?? $detail['quantity'];
                
                // Update stok produk
                $product = products::find($detail['product_id']);
                if ($product) {
                    if ($product->stock < $cartQuantity) {
                        throw new Exception('Stok produk ' . $product->product_name . ' tidak mencukupi. Stok tersedia: ' . $product->stock . ', Dibutuhkan: ' . $cartQuantity);
                    }
                    
                    // Update stok
                    $product->stock -= $cartQuantity;
                    $product->save();
                }

                // Simpan detail pesanan
                orders_details::create([
                    'order_id' => $order->order_id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $cartQuantity,
                    'price' => $detail['price'],
                    'subtotal' => $cartQuantity * $detail['price'],
                ]);
            }

            // Commit transaksi
            DB::commit();

            // Hapus isi keranjang dari session
            session()->forget('cart');

            // Redirect dengan pesan sukses
            return redirect()->route('public.home')->with('success', 'Order berhasil dibuat! Nomor Order: ' . $order->order_id);

        } catch (Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Gagal membuat order: ' . $e->getMessage())->withInput();
        }
    }

    public function history(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $customerId = Auth::guard('customer')->user()->customer_id;

        $query = orders::with('orderDetails.product')
            ->where('customer_id', $customerId)
            ->orderBy('order_date', 'desc');

        $status = $request->input('status');
        if ($status && $status != '') {
            $query->where('status', $status);
        }

        $orders = $query->get();

        $statusCounts = orders::where('customer_id', $customerId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalOrders = orders::where('customer_id', $customerId)->count();

        return view('public.pesanan', compact('orders', 'statusCounts', 'totalOrders'));
    }

    public function cetakStruk($orderId)
    {
        $order = orders::with(['orderDetails.product', 'customer'])->findOrFail($orderId);

        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetFont('Arial', '', 12);

        // HEADER
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'STRUK PEMBELIAN', 0, 1, 'C');
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 5, 'Tanggal Cetak: ' . date('d-m-Y H:i:s'), 0, 1, 'C');
        $pdf->Ln(5);

        // INFO ORDER
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 7, 'INFORMASI ORDER:', 0, 1);
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 6, 'Order ID', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(0, 6, $order->order_id, 0, 1);
        
        $pdf->Cell(40, 6, 'Tanggal Order', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(0, 6, $order->order_date->format('d-m-Y H:i'), 0, 1);
        
        $pdf->Cell(40, 6, 'Status', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(0, 6, $order->status, 0, 1);
        
        $pdf->Cell(40, 6, 'Metode Pembayaran', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $paymentMethodText = $order->payment_method;
        $pdf->Cell(0, 6, $paymentMethodText, 0, 1);
        $pdf->Ln(5);

        // INFO PENERIMA
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 7, 'INFORMASI PENERIMA:', 0, 1);
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 6, 'Nama Penerima', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(0, 6, $order->receiver_name, 0, 1);
        
        $pdf->Cell(40, 6, 'Telepon', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(0, 6, $order->receiver_phone, 0, 1);
        
        $pdf->Cell(40, 6, 'Alamat', 0, 0);
        $pdf->MultiCell(0, 6, ': ' . $order->shipping_address);
        $pdf->Ln(5);

        // DETAIL PRODUK
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 8, 'DETAIL PRODUK:', 0, 1);
        $pdf->Ln(3);

        // Header tabel
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', true);
        $pdf->Cell(80, 8, 'Nama Produk', 1, 0, 'L', true);
        $pdf->Cell(20, 8, 'Qty', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Harga', 1, 0, 'R', true);
        $pdf->Cell(40, 8, 'Subtotal', 1, 1, 'R', true);

        // Data produk
        $pdf->SetFont('Arial', '', 9);
        $no = 1;
        foreach ($order->orderDetails as $detail) {
            $product = $detail->product;
            $subtotal = $detail->quantity * $detail->price;
            
            $pdf->Cell(10, 8, $no++, 1, 0, 'C');
            $pdf->Cell(80, 8, $product->product_name ?? '-', 1, 0, 'L');
            $pdf->Cell(20, 8, $detail->quantity, 1, 0, 'C');
            $pdf->Cell(40, 8, 'Rp ' . number_format($detail->price, 0, ',', '.'), 1, 0, 'R');
            $pdf->Cell(40, 8, 'Rp ' . number_format($subtotal, 0, ',', '.'), 1, 1, 'R');
        }
        $pdf->Ln(5);

        // RINGKASAN PEMBAYARAN
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 8, 'RINGKASAN PEMBAYARAN:', 0, 1);
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(120, 7, 'Total Harga Produk', 0, 0);
        $pdf->Cell(0, 7, 'Rp ' . number_format($order->total_price, 0, ',', '.'), 0, 1, 'R');
        
        $pdf->Cell(120, 7, 'Biaya Pengiriman', 0, 0);
        $pdf->Cell(0, 7, 'Rp ' . number_format($order->shipping_cost, 0, ',', '.'), 0, 1, 'R');
        
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(120, 8, 'GRAND TOTAL', 0, 0);
        $pdf->Cell(0, 8, 'Rp ' . number_format($order->grand_total, 0, ',', '.'), 0, 1, 'R');
        $pdf->Ln(5);

        // CATATAN PELANGGAN
        if ($order->customer_note) {
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 7, 'Catatan:', 0, 1);
            
            $pdf->SetFont('Arial', '', 9);
            $pdf->MultiCell(0, 6, $order->customer_note);
            $pdf->Ln(5);
        }

        // INFO PEMBAYARAN BERDASARKAN METODE
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 7, 'INFORMASI PEMBAYARAN:', 0, 1);
        
        $pdf->SetFont('Arial', '', 9);
        if ($order->payment_method == 'cod') {
            $pdf->MultiCell(0, 6, 'Pembayaran: COD (Cash on Delivery) - Bayar saat barang diterima');
        } else {
            $pdf->MultiCell(0, 6, 'Pembayaran: GATEWAY - Silakan lakukan pembayaran via transfer/ewallet');
        }
        $pdf->Ln(5);

        // FOOTER
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(0, 5, 'Terima kasih atas pembelian Anda', 0, 1, 'C');
        $pdf->Cell(0, 5, 'Simpan struk ini sebagai bukti pembelian', 0, 1, 'C');

        $pdf->Output('I', 'Struk_Order_' . $order->order_id . '.pdf');
        exit;
    }

    public function show($id)
    {
        $order = orders::with(['orderDetails.product', 'customer', 'pembayaran'])
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = orders::with('orderDetails')->findOrFail($id);
        $customers = customers::all();
        $products = products::all();

        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:menunggu,diproses,dikirim,selesai,dibatalkan',
            'receiver_name' => 'nullable|string|max:100',
            'payment_method' => 'nullable|string|in:cod,gateway',
            'shipping_cost' => 'nullable|numeric|min:0',
            'grand_total' => 'nullable|numeric|min:0',
            'receiver_phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|string',
            'customer_note' => 'nullable|string',
        ]);

        if ($request->has('payment_method') && !in_array($request->payment_method, ['cod', 'gateway'])) {
            return redirect()->back()->with('error', 'Metode pembayaran tidak valid. Pilih cod atau gateway.');
        }

        $order = orders::findOrFail($id);

        $order->status = $request->status;
        
        if ($request->has('receiver_name')) {
            $order->receiver_name = $request->receiver_name;
        }
        
        if ($request->has('payment_method')) {
            $order->payment_method = $request->payment_method;
        }
        
        $order->shipping_cost = $request->shipping_cost ?? $order->shipping_cost;
        $order->grand_total = $request->grand_total ?? $order->grand_total;
        $order->receiver_phone = $request->receiver_phone ?? $order->receiver_phone;
        $order->shipping_address = $request->shipping_address ?? $order->shipping_address;
        $order->customer_note = $request->customer_note ?? $order->customer_note;
        
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    /**
     * Method untuk mengecek apakah order sudah lunas/belum
     * (Tambahan untuk kebutuhan tombol pembayaran)
     */
    public function checkPaymentStatus($orderId)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $customerId = Auth::guard('customer')->user()->customer_id;
        
        $order = orders::where('order_id', $orderId)
            ->where('customer_id', $customerId)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json([
            'order_id' => $order->order_id,
            'status' => $order->status,
            'payment_method' => $order->payment_method,
            'grand_total' => $order->grand_total,
            'needs_payment' => ($order->status == 'menunggu' && $order->payment_method != 'cod')
        ]);
    }
}