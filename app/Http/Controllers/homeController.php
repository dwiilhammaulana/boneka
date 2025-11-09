<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\customers;
use App\Models\orders;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data kategori
        $categories = Category::all();

        // Ambil produk dengan filter: stok > 0 dan status 'Approved', diurutkan terbaru
        $products = products::where('stock', '>', 0)
            ->where('status', 'Approved')
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        return view('public.home', compact('categories', 'products'));
    }

    /**
     * Helper function untuk mendapatkan info user yang login
     * Bisa dipanggil dari view manapun
     */
    public static function getUserInfo()
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            return [
                'name' => $user->full_name,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone_number,
                'address' => $user->address,
                'initial' => strtoupper(substr($user->username, 0, 1)),
                'role' => 'Customer',
                // 'order_count' => $user->orders()->count(),
                'member_since' => $user->created_at ? $user->created_at->format('M Y') : 'Recent'
            ];
        }
        return null;
    }

    /**
     * Method untuk mendapatkan data user yang login
     * Bisa digunakan di controller lain juga
     */
    public static function getLoggedInUser()
    {
        if (Auth::guard('customer')->check()) {
            return Auth::guard('customer')->user();
        }
        return null;
    }
}