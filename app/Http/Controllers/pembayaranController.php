<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\orders; 
// Menggunakan model orders
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar semua pembayaran.
     */
    public function index(): View
    {
        $pembayaran = pembayaran::orderBy('tanggal_pembayaran', 'DESC')->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Menampilkan detail pembayaran tertentu.
     */
    public function show($id): View
    {
        $pembayaran = pembayaran::findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function pembayaran($orderId)
{
    $pembayaran = pembayaran::where('order_id', $orderId)->first();

    if (!$pembayaran) {
        return response()->json([
            'message' => 'Data pembayaran tidak ditemukan.'
        ], 404);
    }

    return response()->json([
        'id_pembayaran'      => $pembayaran->id_pembayaran,
        'order_id'           => $pembayaran->order_id,
        'tanggal_pembayaran' => $pembayaran->tanggal_pembayaran,
        'jumlah_bayar'       => $pembayaran->jumlah_bayar
    ]);
}

    /**
     * Menampilkan form untuk input pembayaran baru.
     */
   public function create(Request $request)
{
    $selectedOrderId = $request->input('order_id');
    $jenisPembayaran = 'booking'; // Default jenis pembayaran

    // Ambil data orders berdasarkan peran user
    $orders = collect(); // Default kosong

    if (Auth::guard('admin')->check()) {
        $orders = Orders::all();
    } elseif (Auth::guard('customer')->check()) {
        $customerId = Auth::guard('customer')->id();
        $orders = Orders::where('customer_id', $customerId)->get();
    }

    // Cek jenis pembayaran berdasarkan order yang dipilih
    if ($selectedOrderId) {
        $order = Orders::find($selectedOrderId);

        if ($order) {
            // Cek apakah sudah lunas
            if ($order->sisa_tagihan <= 0) {
                return redirect()->route('orders.index')->with('info', 'Pembayaran Anda sudah lunas.');
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

    return view('pembayaran.create', compact('orders', 'selectedOrderId', 'jenisPembayaran'));
}





    /**
     * Menyimpan data pembayaran ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,order_id',
        'tanggal_pembayaran' => 'required|date',
        'jenis_pembayaran' => 'required|in:booking,dp,pelunasan',
    ]);

    $order = Orders::findOrFail($request->order_id);

    // Hitung nominal pembayaran berdasarkan jenis pembayaran
    $bookingAmount = 500000;
    $total_price = $order->total_price;
    $sisaSetelahBooking = $total_price - $bookingAmount;
    $dpAmount = 0.3 * $sisaSetelahBooking;
    $sisaSetelahDP = $sisaSetelahBooking - $dpAmount;

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

    // Simpan data pembayaran
    Pembayaran::create([
        'order_id' => $request->order_id,
        'tanggal_pembayaran' => $request->tanggal_pembayaran,
        'jenis_pembayaran' => $request->jenis_pembayaran,
        'jumlah_bayar' => $jumlah,
    ]);

    // Update sisa tagihan
    $order->sisa_tagihan = max(0, $order->sisa_tagihan - $jumlah);

    // Fungsi bantu pembanding float
    $isEqual = fn($a, $b) => abs($a - $b) < 1;

    // Update status berdasarkan ketentuan
    if ($isEqual($order->sisa_tagihan, $total_price)) {
        $order->status = 'Menunggu';
    } elseif ($isEqual($order->sisa_tagihan, $total_price - $bookingAmount)) {
        $order->status = 'Dikonfirmasi';
    } elseif ($isEqual($order->sisa_tagihan, $sisaSetelahDP)) {
        $order->status = 'DP';
    } elseif ($order->sisa_tagihan <= 0) {
        $order->status = 'Lunas';
    }

    $order->save();

    return redirect()->route('orders.index')->with('success', 'Pembayaran berhasil disimpan.');
}



    /**
     * Menampilkan form edit pembayaran.
     */
    public function edit($id): View
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $orders = orders::all(); // Untuk pilihan order di dropdown
        return view('pembayaran.edit', compact('pembayaran', 'orders'));
    }

    /**
     * Memperbarui data pembayaran.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'order_id' => $validatedData['order_id'],
            'tanggal_pembayaran' => $validatedData['tanggal_pembayaran'],
            'jumlah_bayar' => $validatedData['jumlah_bayar'],
        ]);

        return redirect()->route('pembayaran.index')->with(['berhasil' => 'Data Pembayaran Berhasil Diupdate!']);
    }

    /**
     * Menghapus data pembayaran.
     */
    public function destroy($id): RedirectResponse
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with(['berhasil' => 'Data Pembayaran Berhasil Dihapus!']);
    }
}
