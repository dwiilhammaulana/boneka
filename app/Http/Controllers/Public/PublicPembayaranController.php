<?php

namespace App\Http\Controllers\Public;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

class PublicPembayaranController extends Controller
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
        $grossAmount = (int) $order->sisa_tagihan; // nominal yang akan dibayar via Midtrans

        $params = [
            'transaction_details' => [
                'order_id' => $transactionId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => optional($order->customer)->name ?? 'Customer',
                'email' => optional($order->customer)->email ?? 'no-reply@example.com',
                'phone' => optional($order->customer)->phone ?? '000',
            ],
            'enabled_payments' => null, // null = default allowed methods; atur array jika ingin
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
                $order->status = 'Lunas';
                $order->sisa_tagihan = 0;
            } elseif ($transactionStatus == 'pending') {
                $order->status = 'Pending';
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
                $order->status = 'Gagal';
            }

            $order->save();

            // simpan log sederhana atau Pembayaran record jika perlu
            Pembayaran::create([
                'order_id' => $order->order_id,
                'tanggal_pembayaran' => now(),
                'jenis_pembayaran' => 'midtrans',
                'jumlah_bayar' => $notif->gross_amount ?? 0,
                'metode' => $notif->payment_type ?? 'midtrans',
                'bukti_bayar' => null,
                'snap_token' => null,
            ]);

            return response('OK', 200);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: '.$e->getMessage());
            return response('Error', 500);
        }
    }

    public function create(Request $request)
    {
        $customerId = Auth::guard('customer')->id();
        $selectedOrderId = $request->input('order_id');
        $jenisPembayaran = 'booking';

        // Ambil semua pesanan milik customer
        $orders = Orders::where('customer_id', $customerId)->get();

        if ($selectedOrderId) {
            $order = $orders->where('order_id', $selectedOrderId)->first();

            if ($order) {
                if ($order->sisa_tagihan <= 0) {
                    return redirect()->route('public.pesanan')
                        ->with('info', 'Pembayaran Anda sudah lunas.');
                }

                $total = $order->total_price;
                $sisa = $order->sisa_tagihan;

                $bookingAmount = 500000;
                $hargaSetelahBooking = $total - $bookingAmount;
                $dpAmount = 0.3 * $hargaSetelahBooking;

                if ($sisa == $total) {
                    $jenisPembayaran = 'booking';
                } elseif ($sisa > ($total - $dpAmount - $bookingAmount)) {
                    $jenisPembayaran = 'dp';
                } else {
                    $jenisPembayaran = 'pelunasan';
                }
            }
        }

        return view('public.pembayaran.create', compact('orders', 'selectedOrderId', 'jenisPembayaran'));
    }


    public function store(Request $request)
{
    
    $request->validate([
        'order_id' => 'required|exists:orders,order_id',
        'tanggal_pembayaran' => 'required|date',
        'jenis_pembayaran' => 'required|in:booking,dp,pelunasan',
        'metode' => 'required|in:tunai,transfer',
        'bukti_bayar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $order = Orders::findOrFail($request->order_id);

    $bookingAmount = 500000;
    $total_price = $order->total_price;
    $sisaSetelahBooking = $total_price - $bookingAmount;
    $dpAmount = 0.3 * $sisaSetelahBooking;
    $sisaSetelahDP = $sisaSetelahBooking - $dpAmount;

    // Hitung jumlah bayar sesuai jenis pembayaran
    switch ($request->jenis_pembayaran) {
        case 'booking':
            $jumlah = $bookingAmount;
            break;
        case 'dp':
            $jumlah = $dpAmount;
            break;
        case 'pelunasan':
            $jumlah = $order->sisa_tagihan;
            break;
        default:
            $jumlah = 0;
    }

    // Simpan nama file saja (jika metode transfer dan ada file)
    $namaFile = null;
    if ($request->metode === 'transfer' && $request->hasFile('bukti_bayar')) {
        $file = $request->file('bukti_bayar');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/bukti_bayar', $namaFile);
    }

    // Simpan data pembayaran
    Pembayaran::create([
        'order_id' => $request->order_id,
        'tanggal_pembayaran' => $request->tanggal_pembayaran,
        'jenis_pembayaran' => $request->jenis_pembayaran,
        'jumlah_bayar' => $jumlah,
        'metode' => $request->metode,
        'bukti_bayar' => $namaFile,
    ]);

    // Update sisa tagihan
    $order->sisa_tagihan = max(0, $order->sisa_tagihan - $jumlah);

    // Fungsi bantu pembanding float
    $isEqual = fn($a, $b) => abs($a - $b) < 1;

    // Update status dan dokumen
    if ($isEqual($order->sisa_tagihan, $total_price)) {
        $order->status = 'Menunggu';
    } elseif ($isEqual($order->sisa_tagihan, $total_price - $bookingAmount)) {
        $order->status = 'Dikonfirmasi';
    } elseif ($isEqual($order->sisa_tagihan, $sisaSetelahDP)) {
        $order->status = 'DP';
        $order->stnk = 'diproses';
        $order->bpkb = 'diproses';
    } elseif ($order->sisa_tagihan <= 0) {
        $order->status = 'Lunas';
    }

    $order->save();

    return redirect()->route('public.pesanan')->with('success', 'Pembayaran berhasil disimpan.');
}
}
