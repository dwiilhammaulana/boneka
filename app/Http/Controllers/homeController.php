<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Ambil produk: stok > 0, urutkan terbaru, limit 8
        $products = Products::where('stock', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        return view('public.home', compact('categories', 'products'));
    }

    /**
     * Helper untuk mengambil info user login (dipakai di view)
     */
    public static function getUserInfo()
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();

            return [
                'name'        => $user->full_name,
                'username'    => $user->username,
                'email'       => $user->email,
                'phone'       => $user->phone_number,
                'address'     => $user->address,
                'initial'     => strtoupper(substr($user->username, 0, 1)),
                'role'        => 'Customer',
                'member_since'=> $user->created_at 
                                    ? $user->created_at->format('M Y') 
                                    : 'Recent',
            ];
        }

        return null;
    }

    /**
     * Ambil user login (jika diperlukan di controller lain)
     */
    public static function getLoggedInUser()
    {
        return Auth::guard('customer')->check() 
            ? Auth::guard('customer')->user() 
            : null;
    }
}
