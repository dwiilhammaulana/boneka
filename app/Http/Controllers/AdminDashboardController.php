<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\customers;
use App\Models\products;
use App\Models\orders;
use App\Models\contact_us;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
{
    $adminCount = \App\Models\Admin::count();
    $customerCount = \App\Models\customers::count();
    $productCount = \App\Models\products::count();
    $orderCount = orders::count();
    $messagesCount = \App\Models\contact_us::count();

    // Hitung jumlah berdasarkan status
    $statusCounts = orders::selectRaw("status, COUNT(*) as total")
        ->groupBy('status')
        ->pluck('total', 'status');

    // Ambil pesanan terbaru
    $recentOrders = orders::with('customer')->latest()->take(5)->get();

    return view('dashboard.index', [
        'adminCount' => $adminCount,
        'customerCount' => $customerCount,
        'productCount' => $productCount,
        'orderCount' => $orderCount,
        'messagesCount' => $messagesCount,
        'statusCounts' => $statusCounts,
        'recentOrders' => $recentOrders,
    ]);
}
}
