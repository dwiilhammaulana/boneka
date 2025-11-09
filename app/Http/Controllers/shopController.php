<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Models\Category;

class shopController extends Controller
{
    /**
     * Display the shop page with products and categories.
     */
    public function index()
    {
        // Ambil data kategori
        $categories = Category::all();

        // Ambil produk terbaru (misalnya 8 produk terakhir)
        $products = products::orderBy('created_at', 'DESC')->take(8)->get();

        return view('public.shop', compact('categories', 'products'));
    }

    /**
     * Show the detail of a specific product.
     */
    public function show($id)
    {
        // Cari produk berdasarkan ID
        $product = products::with('category')->findOrFail($id);

        // Kirim data produk ke view
        return view('public.product', compact('product'));
    }

}
