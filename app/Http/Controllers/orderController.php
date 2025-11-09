<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\orders_details;
use App\Models\customers;
use App\Models\products;
use Illuminate\Support\Facades\Auth;
use FPDF;
use Imagick;
require_once app_path('Libraries/FPDF/fpdf.php');

class orderController extends Controller
{
    public function index()
    {
        // Mengambil semua order beserta detailnya
        $orders = orders::with('orderDetails.product')->get();

        return view('orders.index', compact('orders'));
    }

    
    // Menampilkan form untuk membuat order bar

public function create()
{
    // Cek apakah customer sudah login dengan guard 'customer'
    if (!Auth::guard('customer')->check()) {
        // Jika belum login, redirect ke halaman login customer dengan pesan error
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    
    // Jika sudah login (else tidak perlu karena sudah ada return di atas)
    $cart = session('cart', []); // Ambil data keranjang dari session
    $customers = customers::all(); // Ambil data pelanggan
    $products = products::all(); // Ambil data produk

    return view('public.checkout', compact('cart', 'customers', 'products'));
}

public function cancel(orders $order)
{
    $order->status = 'Batal';
    $order->save();

    return response()->json(['message' => 'Status pesanan sudah diubah menjadi Batal']);
}

public function updateLogistik(Request $request, $id)
{
    $order = orders::findOrFail($id);

    $validated = $request->validate([
        'logistik' => 'required|in:request_pickup,pickup',
    ]);

    $order->logistik = $validated['logistik'];
    $order->save();

    return response()->json(['success' => true, 'message' => 'Status logistik berhasil diperbarui.']);
}



    // Menyimpan order baru beserta detailnya

   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'customer_id' => 'required|exists:customers,customer_id',
        'order_date' => 'required|date',
        'total_price' => 'required|numeric',
        'bukti_pesanan' => 'required',
        'status' => 'required|string',
        'ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'order_details' => 'required|array',
        'order_details.*.product_id' => 'required|exists:products,product_id',
        'order_details.*.quantity' => 'required|integer',
        'order_details.*.price' => 'required|numeric',
    ]);

    // Hapus titik dari nilai bukti_pesanan, lalu cast ke integer
    $bukti = (int) str_replace('.', '', $request->bukti_pesanan);

    // Simpan file gambar KTP
    $ktpPath = $this->saveImage($request, 'ktp', 'uploads/ktp');

    // Simpan data order
    $order = Orders::create([
        'customer_id'   => $request->customer_id,
        'order_date'    => $request->order_date,
        'total_price'   => $request->total_price,
        'bukti_pesanan' => $bukti,
        'ktp'           => $ktpPath,
        'status'        => $request->status,
        'sisa_tagihan'  => $request->total_price,
    ]);

    // Simpan detail pesanan
    foreach ($request->order_details as $detail) {
        Orders_Details::create([
            'order_id'   => $order->order_id,
            'product_id' => $detail['product_id'],
            'quantity'   => $detail['quantity'],
            'price'      => $detail['price'],
        ]);
    }

    // Hapus isi keranjang dari session
    session()->forget('cart');

    // Redirect dengan pesan sukses
    return redirect()->route('public.home')->with('success', 'Order berhasil dibuat dan keranjang Anda telah dikosongkan!');
}




    public function history()
{
    // Cek apakah user sudah login sebagai customer
    if (!Auth::guard('customer')->check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    // Mendapatkan customer_id dari Auth guard
    $customerId = Auth::guard('customer')->user()->customer_id;

    // Mengambil data order dan details berdasarkan customer_id
    $orders = orders::with('orderDetails.product')
        ->where('customer_id', $customerId)
        ->orderBy('order_date', 'desc')
        ->get();

    // Kirim data ke view
    return view('public.pesanan', compact('orders'));
}


public function cetakStruk($orderId)
{
    $order = orders::with(['orderDetails.product', 'customer'])->findOrFail($orderId);

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->SetFont('Arial', '', 12);

    // TIMESTAMP DI POJOK KANAN ATAS
    date_default_timezone_set('Asia/Jakarta');
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(0, 5, 'Dicetak: ' . date('d-m-Y H:i:s'), 0, 0, 'R');
    $pdf->Ln(10);

    // HEADER DENGAN THEMA KUNING
    $pdf->SetFillColor(253, 224, 71); // Kuning
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'MOBILSHIFT', 0, 1, 'C', true);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 8, 'Dealer Mobil Bekas Terpercaya', 0, 1, 'C', true);
    
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(80, 80, 80);
    $pdf->MultiCell(0, 5, "Arengka 1 No 36 D-E, Jl. Soekarno - Hatta\nSidomulyo Tim., Kecamatan Marpoyan, Kota Pekanbaru, Riau 28125\nTelp: 0852-6552-7838 | Email: info@mobilshift.com");
    $pdf->Ln(8);

    // GARIS PEMISAH
    $pdf->SetDrawColor(245, 158, 11); // Dark Yellow
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(5);

    // INFO CUSTOMER
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(245, 158, 11); // Dark Yellow
    $pdf->Cell(0, 7, 'INFORMASI PELANGGAN:', 0, 1);
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(40, 6, 'Nama', 0, 0);
    $pdf->Cell(5, 6, ':', 0, 0);
    $pdf->Cell(0, 6, $order->customer->username ?? $order->customer->full_name ?? '-', 0, 1);
    
    $pdf->Cell(40, 6, 'No. Telepon', 0, 0);
    $pdf->Cell(5, 6, ':', 0, 0);
    $pdf->Cell(0, 6, $order->customer->phone_number ?? '-', 0, 1);
    
    $pdf->Cell(40, 6, 'Email', 0, 0);
    $pdf->Cell(5, 6, ':', 0, 0);
    $pdf->Cell(0, 6, $order->customer->email ?? '-', 0, 1);
    $pdf->Ln(8);

    // ORDER INFO TABLE DENGAN THEMA KUNING
    $headers = ['ORDER ID', 'TANGGAL', 'STNK', 'BPKB', 'STATUS'];
    $pdf->SetFillColor(245, 158, 11); // Dark Yellow
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 9);

    $colWidth = 190 / count($headers);
    foreach ($headers as $header) {
        $pdf->Cell($colWidth, 8, $header, 1, 0, 'C', true);
    }
    $pdf->Ln();

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 9);

    $bulanIndo = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    $tanggal = date('j', strtotime($order->order_date));
    $bulan = $bulanIndo[(int)date('n', strtotime($order->order_date))];
    $tahun = date('Y', strtotime($order->order_date));
    $tanggalBeli = "$tanggal $bulan $tahun";

    $infoData = [
        $order->order_id,
        $tanggalBeli,
        $order->stnk ?? '-',
        $order->bpkb ?? '-',
        $order->status ?? '-'
    ];
    foreach ($infoData as $info) {
        $pdf->Cell($colWidth, 8, $info, 1, 0, 'C');
    }
    $pdf->Ln(10);

    // TABEL LOGISTIK jika status = lunas
    if (strtolower($order->status) === 'lunas') {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(251, 146, 60); // Orange
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(190, 8, 'INFORMASI PENGAMBILAN MOBIL', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(190, 8, strtoupper($order->logistik ?? 'BELUM DITENTUKAN'), 1, 1, 'C');
        $pdf->Ln(8);
    }

    // DETAIL PRODUK DENGAN HEADER KUNING
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(245, 158, 11);
    $pdf->Cell(0, 8, 'DETAIL PRODUK:', 0, 1);
    $pdf->Ln(3);

    $columns = ['No', 'Nama Produk', 'Kilometer', 'Warna', 'Jumlah', 'Harga'];
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(253, 224, 71); // Kuning
    $pdf->SetTextColor(0, 0, 0);

    // Hitung lebar kolom
    $colWidths = [15, 60, 25, 25, 20, 45];
    $totalWidth = array_sum($colWidths);

    // Header tabel
    foreach ($columns as $i => $col) {
        $pdf->Cell($colWidths[$i], 10, $col, 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Data produk
    $pdf->SetFont('Arial', '', 9);
    $no = 1;
    $totalProduk = 0;
    foreach ($order->orderDetails as $detail) {
        $product = $detail->product;
        $subtotal = $detail->price * $detail->quantity;
        $totalProduk += $subtotal;

        $values = [
            $no++,
            substr($product->product_name ?? '-', 0, 25),
            ($product->kilometer ?? '-') . ' Km',
            substr($product->warna ?? '-', 0, 8),
            $detail->quantity,
            'Rp ' . number_format($detail->price, 0, ',', '.'),
        ];

        foreach ($values as $i => $val) {
            $pdf->Cell($colWidths[$i], 8, $val, 1, 0, 'C');
        }
        $pdf->Ln();
    }

    $pdf->Ln(5);

    // RINGKASAN PEMBAYARAN DENGAN BACKGROUND KUNING
    $buktiPesanan = 500000;
    $total = $totalProduk + $buktiPesanan;
    $sisaTagihan = $order->sisa_tagihan ?? $total;

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(245, 158, 11);
    $pdf->Cell(0, 8, 'RINGKASAN PEMBAYARAN:', 0, 1);
    $pdf->Ln(3);

    $pdf->SetFillColor(255, 253, 240); // Light yellow background
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 10);

    // Buat box untuk ringkasan pembayaran
    $startY = $pdf->GetY();
    $pdf->Rect(10, $startY, 190, 40, 'F');
    $pdf->SetDrawColor(245, 158, 11);
    $pdf->Rect(10, $startY, 190, 40);

    $pdf->SetXY(15, $startY + 5);
    $pdf->Cell(120, 7, 'Jumlah Total Produk', 0, 0);
    $pdf->Cell(50, 7, 'Rp ' . number_format($totalProduk, 0, ',', '.'), 0, 1, 'R');

    $pdf->SetX(15);
    $pdf->Cell(120, 7, 'Bukti Pesanan', 0, 0);
    $pdf->Cell(50, 7, 'Rp ' . number_format($buktiPesanan, 0, ',', '.'), 0, 1, 'R');

    $pdf->SetX(15);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(120, 8, 'TOTAL PEMBAYARAN', 0, 0);
    $pdf->Cell(50, 8, 'Rp ' . number_format($total, 0, ',', '.'), 0, 1, 'R');

    $pdf->SetX(15);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 7, 'Sisa Tagihan', 0, 0);
    $pdf->Cell(50, 7, 'Rp ' . number_format($sisaTagihan, 0, ',', '.'), 0, 1, 'R');

    $pdf->SetY($startY + 40);
    $pdf->Ln(5);

    // INFO BATAS PEMBAYARAN JIKA STATUS DIKONFIRMASI
    if (strtolower($order->status) === 'dikonfirmasi') {
        $tglTempo = date('Y-m-d', strtotime($order->order_date . ' +7 days'));
        $tgl = date('j', strtotime($tglTempo));
        $bln = $bulanIndo[(int)date('n', strtotime($tglTempo))];
        $thn = date('Y', strtotime($tglTempo));
        $tanggalTempo = "$tgl $bln $thn";

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetTextColor(220, 53, 69);
        $pdf->Cell(0, 6, '⏰ BAYAR SEBELUM: ' . $tanggalTempo, 0, 1, 'C');
        $pdf->Ln(3);
    }

    // CEK DAN TAMPILKAN GAMBAR KTP
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(245, 158, 11);
    $pdf->Cell(0, 8, 'DOKUMEN KTP:', 0, 1);
    
    $ktpPath = public_path('uploads/ktp/' . $order->ktp);

    if ($order->ktp && file_exists($ktpPath)) {
        try {
            // Cek tipe file dan ukuran
            $imageInfo = getimagesize($ktpPath);
            if ($imageInfo !== false) {
                $imageWidth = $imageInfo[0];
                $imageHeight = $imageInfo[1];
                
                // Hitung ukuran untuk ditampilkan di PDF (maksimal lebar 80mm)
                $maxWidth = 80;
                $maxHeight = 60;
                
                $ratio = $imageWidth / $imageHeight;
                
                if ($imageWidth > $maxWidth || $imageHeight > $maxHeight) {
                    if ($ratio > 1) {
                        // Landscape
                        $displayWidth = $maxWidth;
                        $displayHeight = $maxWidth / $ratio;
                    } else {
                        // Portrait
                        $displayHeight = $maxHeight;
                        $displayWidth = $maxHeight * $ratio;
                    }
                } else {
                    $displayWidth = $imageWidth * 0.35; // Scale down
                    $displayHeight = $imageHeight * 0.35;
                }
                
                // Pastikan tidak melebihi batas halaman
                $currentY = $pdf->GetY();
                if ($currentY + $displayHeight > 250) {
                    $pdf->AddPage();
                }
                
                // Tambahkan border untuk gambar
                $pdf->SetDrawColor(245, 158, 11);
                $pdf->SetLineWidth(0.5);
                $pdf->Rect(10, $pdf->GetY(), $displayWidth + 4, $displayHeight + 4);
                
                // Tampilkan gambar
                $pdf->Image($ktpPath, 12, $pdf->GetY() + 2, $displayWidth, $displayHeight);
                $pdf->SetY($pdf->GetY() + $displayHeight + 10);
                
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(100, 100, 100);
                $pdf->Cell(0, 5, 'KTP terlampir - ' . $order->ktp, 0, 1);
                
            } else {
        throw new Exception('File bukan gambar yang valid');
    }
    } catch (Exception $e) {
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(150, 150, 150);
        $pdf->Cell(0, 5, 'Gagal memuat gambar KTP: ' . $e->getMessage(), 0, 1);
    }
    } else {
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(150, 150, 150);
        $pdf->Cell(0, 5, 'Belum ada dokumen KTP yang diunggah', 0, 1);
    }

    $pdf->Ln(8);

    // FOOTER DENGAN THEMA KUNING
    $pdf->SetDrawColor(245, 158, 11);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor(245, 158, 11);
    $pdf->Cell(0, 6, 'TERIMA KASIH TELAH MEMBELI DI MOBILSHIFT', 0, 1, 'C');
    
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(0, 5, 'Struk ini merupakan bukti pembelian yang sah', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Simpan struk ini untuk keperluan administrasi', 0, 1, 'C');
    
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetTextColor(245, 158, 11);
    $pdf->Cell(0, 5, 'www.mobilshift.com | 0852-6552-7838', 0, 1, 'C');

    $pdf->Output('I', 'Struk_MobilShift_' . $order->order_id . '.pdf');
    exit;
}


    // Menampilkan detail order tertentu
    public function show($id)
    {
        $order = orders::with('orderDetails.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    // Menampilkan form untuk mengedit order
    public function edit($id)
    {
        // Mengambil data order beserta detailnya
        $order = Orders::with('details')->findOrFail($id);

        // Mengambil data pelanggan dan produk untuk dropdown
        $customers = Customers::all();
        $products = Products::all();

        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    // Menyimpan perubahan pada order
    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string',
        'stnk' => 'nullable|string',
        'bpkb' => 'nullable|string',
        'logistik' => 'nullable|string',
        'sisa_tagihan' => 'required|numeric',
        'ktp_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $order = orders::findOrFail($id);

    // Proses upload file KTP baru jika ada
    if ($request->hasFile('ktp_file')) {
        $file = $request->file('ktp_file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/ktp'), $filename);

        // Hapus file KTP lama jika ada
        if ($order->ktp && file_exists(public_path('uploads/ktp/' . $order->ktp))) {
            unlink(public_path('uploads/ktp/' . $order->ktp));
        }

        $order->ktp = $filename;
    }

    // Update data yang boleh diubah
    $order->status = $request->status;
    $order->stnk = $request->stnk;
    $order->bpkb = $request->bpkb;
    $order->logistik = $request->logistik;
    $order->sisa_tagihan = $request->sisa_tagihan;
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
}


protected function saveImage(Request $request, $field, $folder = 'uploads/ktp')
{
    if ($request->hasFile($field)) {
        $file = $request->file($field);
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($folder), $filename); // simpan ke public/uploads/ktp
        return $filename;
    }
    return null;
}



    public function checkout()
    {
        // Ambil data keranjang dari sesi
        $cart = session('cart', []);

        // Ambil data pelanggan (opsional jika diperlukan)
        $customers = customers::all();

        return view('public.checkout', compact('cart', 'customers'));
    }


}
