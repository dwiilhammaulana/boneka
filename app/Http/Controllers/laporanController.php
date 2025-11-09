<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan   = $request->input('bulan');
        $tahun   = $request->input('tahun');

        // Filter waktu & status lunas
        $orderQuery = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.customer_id')
            ->where('orders.status', 'Lunas');

        if ($tanggal) {
            $orderQuery->whereDate('orders.order_date', $tanggal);
        }

        if ($bulan) {
            $orderQuery->whereMonth('orders.order_date', $bulan);
        }

        if ($tahun) {
            $orderQuery->whereYear('orders.order_date', $tahun);
        }

        // Ambil semua pesanan lunas
        $dataPenjualan = $orderQuery
            ->select(
                'orders.order_id',
                'orders.order_date',
                'customers.full_name',
                'orders.total_price'
            )
            ->orderBy('orders.order_date', 'desc')
            ->get();

        // Total penjualan (langsung dari orders.total_price)
        $totalPendapatan = $dataPenjualan->sum('total_price');

        return view('laporan.penjualan', compact(
            'dataPenjualan',
            'totalPendapatan',
            'tanggal',
            'bulan',
            'tahun'
        ));
    }
    public function mobilDariCustomer(Request $request)
{
    $tanggal = $request->input('tanggal');
    $bulan   = $request->input('bulan');
    $tahun   = $request->input('tahun');

    $query = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.category_id')
        ->where('products.created_by_type', 'App\\Models\\Customer');

    if ($tanggal) {
        $query->whereDate('products.created_at', $tanggal);
    }

    if ($bulan) {
        $query->whereMonth('products.created_at', $bulan);
    }

    if ($tahun) {
        $query->whereYear('products.created_at', $tahun);
    }

    $products = $query->select(
        'products.product_name',
        'products.price',
        'products.stock',
        'products.warna',
        'products.tahun',
        'products.kilometer',
        'products.status',
        'products.created_at',
        'categories.category_name'
    )->orderBy('products.created_at', 'desc')->get();
        
    return view('laporan.mobil_customer', compact('products', 'tanggal', 'bulan', 'tahun'));  // ✅ FIX

}
}