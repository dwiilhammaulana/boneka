<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PublicPembayaranController extends Controller
{
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
