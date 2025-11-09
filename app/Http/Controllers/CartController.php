<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    // Ambil isi session cart, jika belum ada maka kosongkan sebagai array
    $cart = session('cart', []);

    // Ambil input dari request
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1); // Default quantity = 1

    // Ambil produk beserta relasi kategorinya
    $product = products::with('category')->find($productId);

    // Validasi apakah produk ditemukan
    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }

    // Cek apakah produk sudah ada di dalam keranjang
    if (isset($cart[$productId])) {
        // Tambahkan quantity jika produk sudah ada
        $cart[$productId]['quantity'] += $quantity;
    } else {
        // Tambahkan item baru ke keranjang
        $cart[$productId] = [
            'name' => $product->product_name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image' => $product->image_url,
            'warna' => $product->warna,
            'tahun' => $product->tahun,
            'kilometer' => $product->kilometer,
            'category_id' => $product->category_id,
        ];
    }

    // Simpan keranjang kembali ke session
    session()->put('cart', $cart);

    // Redirect dengan pesan sukses
    return redirect()->route('public.cart.view')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}




public function removeFromCart(Request $request)
{
    // Ambil ID dari request body
    $id = $request->input('id');
    
    $cart = session()->get('cart', []);

    // Cek jika ID ada dalam keranjang dan hapus produk
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    // Kirim respon JSON
    return response()->json(['success' => true]);
}




public function destroy($id)
{
    $cart = session()->get('cart', []);
    
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('public.cart.view')->with('success', 'Produk berhasil dihapus dari keranjang.');
}


    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('public/cart', compact('cart'));
    }


}
