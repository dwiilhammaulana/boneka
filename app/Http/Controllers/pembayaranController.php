<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;


class PembayaranController extends Controller
{


     public function getSnapToken(Request $request)
    {
        // set config midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = filter_var(config('midtrans.isProduction'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized  = filter_var(config('midtrans.isSanitized'), FILTER_VALIDATE_BOOLEAN);
        Config::$is3ds = filter_var(config('midtrans.is3ds'), FILTER_VALIDATE_BOOLEAN);

        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
        ]);

        $order = Orders::where('order_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // buat transaction details
        $transactionId = 'GT-' . time() . '-' . $order->order_id;
        $grossAmount = (int) $order->grand_total; // nominal yang akan dibayar via Midtrans

        $params = [
             'transaction_details' => [
        'order_id' => $transactionId,
        'gross_amount' => $grossAmount,
    ],
    'custom_field1' => $order->order_id, // ⭐ PENTING
];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Error: '.$e->getMessage());
            return response()->json(['error' => 'Failed generate snap token'], 500);
        }
    }

    // -----------------------
    // METHOD: midtransNotification (server-to-server)
    public function midtransNotification(Request $request)
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = filter_var(config('midtrans.isProduction'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized  = filter_var(config('midtrans.isSanitized'), FILTER_VALIDATE_BOOLEAN);
        Config::$is3ds = filter_var(config('midtrans.is3ds'), FILTER_VALIDATE_BOOLEAN);

        $notif = new \Midtrans\Notification($request->all());

        // dapatkan data
        $transactionStatus = $notif->transaction_status ?? null;
        $fraudStatus = $notif->fraud_status ?? null;
        $orderId = $notif->order_id ?? null; // ini adalah transactionId yang kita buat (GT-...)

        // implementasi mapping status => update ke tabel pembayaran / orders
        // kamu bisa mencari order berdasarkan order reference contained in order_id.
        // Jika kamu menambahkan original order_id di custom_field, sesuaikan.
        try {
            // contoh: order_id kita format 'GT-<timestamp>-<order->order_id>'
            $parts = explode('-', $orderId);
            $originalOrderId = end($parts); // asumsikan terakhir adalah order->order_id

            $order = Orders::where('order_id', $originalOrderId)->first();
            if (!$order) {
                Log::warning("Midtrans notification: order not found for $originalOrderId");
                return response('Order not found', 200);
            }

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    // pembayaran challenge
                    $order->status = 'Pembayaran Challenge';
                } else {
                    // pembayaran sukses
                    $order->status = 'Lunas';
                    $order->sisa_tagihan = 0;
                }
            } elseif ($transactionStatus == 'settlement') {
                // dana settled (sukses)
                $order->status = 'menunggu';
                $order->sisa_tagihan = 0;
            } elseif ($transactionStatus == 'diproses') {
                $order->status = 'Diproses';
             } elseif ($transactionStatus == 'dikirim') {
                $order->status = 'Dikirim';     
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
                $order->status = 'Dibatalkan';
            }

            $order->save();

            // simpan log sederhana atau Pembayaran record jika perlu
            Pembayaran::create([
                'order_id' => $order->order_id,
                'tanggal_pembayaran' => now(),
                'jenis_pembayaran' => 'midtrans',
                'jumlah_bayar' => $notif->gross_amount ?? 0,
                'metode' => $notif->payment_type ?? 'midtrans',
            ]);

            return response('OK', 200);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: '.$e->getMessage());
            return response('Error', 500);
        }
    }

    /**
     * -------- FORM CREATE PEMBAYARAN --------
     */
    public function create(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $order = Orders::where('order_id', $request->order_id)
            ->where('customer_id', Auth::guard('customer')->user()->customer_id)
            ->where('status', 'menunggu')
            ->where('payment_method', 'gateway')
            ->firstOrFail();
        
        return view('public.pembayaran.create', compact('order'));
    }

    /**
     * -------- STORE PEMBAYARAN --------
     */
    public function store(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'jumlah_bayar' => 'required|numeric|min:1',
            'tanggal_pembayaran' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // Cek order
            $order = Orders::where('order_id', $request->order_id)
                ->where('customer_id', Auth::guard('customer')->user()->customer_id)
                ->where('status', 'menunggu')
                ->where('payment_method', 'gateway')
                ->firstOrFail();

            // Validasi jumlah bayar harus sama dengan grand_total
            if ($request->jumlah_bayar != $order->grand_total) {
                throw new \Exception('Jumlah pembayaran harus sama dengan total pesanan: Rp ' . number_format($order->grand_total, 0, ',', '.'));
            }

           
            // Simpan pembayaran
            $pembayaran = Pembayaran::create([
                'order_id' => $order->order_id,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'jumlah_bayar' => $request->jumlah_bayar,
               
                'snap_token' => null,
            ]);

            // LOGIKA UTAMA: Update status order menjadi diproses
            $order->status = 'diproses';
            $order->save();

            DB::commit();

            return redirect()->route('public.pesanan')
                ->with('success', 'Pembayaran berhasil dikirim! Pesanan sedang diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menyimpan pembayaran: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * -------- INDEX PEMBAYARAN (Admin) --------
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('order')
            ->orderBy('tanggal_pembayaran', 'DESC')
            ->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * DETAIL PEMBAYARAN
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with('order')->findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * API: Ambil pembayaran berdasarkan Order ID
     */
    public function pembayaran($orderId)
    {
        $pembayaran = Pembayaran::where('order_id', $orderId)->first();

        if (!$pembayaran) {
            return response()->json([
                'message' => 'Data pembayaran tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'id_pembayaran'      => $pembayaran->id_pembayaran,
            'order_id'           => $pembayaran->order_id,
            'tanggal_pembayaran' => $pembayaran->tanggal_pembayaran,
            'jumlah_bayar'       => $pembayaran->jumlah_bayar,
            'bukti_bayar'        => $pembayaran->bukti_bayar
        ]);
    }

    /**
     * EDIT PEMBAYARAN (Admin)
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    /**
     * UPDATE PEMBAYARAN (Admin)
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_pembayaran' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($validated);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data Pembayaran berhasil diupdate!');
    }

    /**
     * HAPUS PEMBAYARAN (Admin)
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        // Optional: Jika ingin mengembalikan status order ke menunggu saat pembayaran dihapus
        if ($pembayaran->order) {
            // Cek apakah ini satu-satunya pembayaran untuk order ini
            $pembayaranCount = Pembayaran::where('order_id', $pembayaran->order_id)->count();
            if ($pembayaranCount <= 1) {
                $pembayaran->order->status = 'menunggu';
                $pembayaran->order->save();
            }
        }
        
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data Pembayaran berhasil dihapus!');
    }

    /**
     * VERIFIKASI PEMBAYARAN (Admin) - Mengubah status order menjadi diproses
     */
    public function verifikasi($id)
    {
        DB::beginTransaction();
        
        try {
            $pembayaran = Pembayaran::with('order')->findOrFail($id);
            
            // Cek apakah order terkait ada
            if ($pembayaran->order) {
                // LOGIKA: Update status order menjadi diproses setelah verifikasi
                $pembayaran->order->status = 'diproses';
                $pembayaran->order->save();
                
                DB::commit();
                
                return redirect()->back()
                    ->with('success', 'Pembayaran telah diverifikasi! Status order telah diubah menjadi diproses.');
            } else {
                throw new \Exception('Order tidak ditemukan.');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memverifikasi pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * BATALKAN VERIFIKASI PEMBAYARAN (Admin) - Mengembalikan status order ke menunggu
     */
    public function batalkanVerifikasi($id)
    {
        DB::beginTransaction();
        
        try {
            $pembayaran = Pembayaran::with('order')->findOrFail($id);
            
            // Cek apakah order terkait ada
            if ($pembayaran->order) {
                // LOGIKA: Kembalikan status order ke menunggu
                $pembayaran->order->status = 'menunggu';
                $pembayaran->order->save();
                
                DB::commit();
                
                return redirect()->back()
                    ->with('success', 'Verifikasi pembayaran dibatalkan! Status order telah dikembalikan ke menunggu.');
            } else {
                throw new \Exception('Order tidak ditemukan.');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal membatalkan verifikasi: ' . $e->getMessage());
        }
    }
}