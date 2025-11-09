<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class productsController extends Controller
{
    public function index()
    {
        $products = products::with('category')->orderBy('created_at', 'DESC')->get();
        return view('products.index', compact('products'));
    }

    public function latestProducts()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $products = products::with('category')->orderBy('created_at', 'DESC')->take(8)->get();
        return view('latest-products', compact('categories', 'products'));
    }

    public function detail($id)
    {
        Log::info('ID Produk:', ['id' => $id]); // Log ID ke storage/logs/laravel.log
        $product = products::with('category')->findOrFail($id);

        // Ambil produk terkait berdasarkan kategori yang sama
        $relatedProducts = products::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id) // Pastikan menggunakan kolom yang benar
            ->take(4)
            ->get();

        return view('public.product', compact('product', 'relatedProducts'));
    }

    public function show($id)
    {
        Log::info('ID produk :', ['id' => $id]);
        $product = products::with('category')->findOrFail($id);

        $relatedProducts = products::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->take(4)
            ->get();

        return view('public.product', compact('product', 'relatedProducts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

public function store(Request $request)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,category_id',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'warna' => 'nullable|string|max:50',
        'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
        'kilometer' => 'nullable|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Upload gambar
    $imageName = $this->saveImage($request, 'image', '');
    $imageUrl2Name = $this->saveImage($request, 'image2', '_2');
    $imageUrl3Name = $this->saveImage($request, 'image3', '_3');
    $imageUrl4Name = $this->saveImage($request, 'image4', '_4');
    $imageUrl5Name = $this->saveImage($request, 'image5', '_5');

    // Debug logging untuk memeriksa guard yang aktif
    Log::debug('Auth check', [
        'admin' => Auth::guard('admin')->check(),
        'customer' => Auth::guard('customer')->check(),
        'user' => Auth::user()
    ]);

    // Menentukan creator (admin/customer)
    if (Auth::guard('customer')->check()) {
        $creator = Auth::guard('customer')->user();
        $creatorType = 'App\\Models\\Customer'; // Nama model, bukan nama tabel
        $creatorId = $creator->customer_id;
        $status = 'pending';
        $redirectRoute = 'public.home'; // Redirect ke home untuk customer
    } elseif (Auth::guard('admin')->check()) {
        $creator = Auth::guard('admin')->user();
        $creatorType = 'App\\Models\\Admin'; // Nama model, bukan nama tabel
        $creatorId = $creator->admin_id;
        $status = 'approved';
        $redirectRoute = 'products.index'; // Redirect ke admin/products untuk admin
    } else {
        return redirect()->back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
    }

    // Membuat produk
    products::create([
        'product_name'    => $request->product_name,
        'category_id'     => $request->category_id,
        'price'           => $request->price,
        'stock'           => $request->stock,
        'description'     => $request->description,
        'warna'           => $request->warna,
        'tahun'           => $request->tahun,
        'kilometer'       => $request->kilometer,
        'status'          => $status,
        'created_by_id'   => $creatorId,
        'created_by_type' => $creatorType,
        'image_url'       => $imageName,
        'image_url2'      => $imageUrl2Name,
        'image_url3'      => $imageUrl3Name,
        'image_url4'      => $imageUrl4Name,
        'image_url5'      => $imageUrl5Name,
    ]);

    return redirect()->route($redirectRoute)->with('success', 'Produk berhasil ditambahkan.');
}

    public function edit($id)
    {
        $product = products::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'warna' => 'nullable|string|max:50',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'kilometer' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = products::findOrFail($id);

        $imageName = $this->updateImage($request, $product, 'image', 'image_url');
        $imageUrl2Name = $this->updateImage($request, $product, 'image2', 'image_url2');
        $imageUrl3Name = $this->updateImage($request, $product, 'image3', 'image_url3');
        $imageUrl4Name = $this->updateImage($request, $product, 'image4', 'image_url4');
        $imageUrl5Name = $this->updateImage($request, $product, 'image5', 'image_url5');

        $product->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'warna' => $request->warna,
            'tahun' => $request->tahun,
            'kilometer' => $request->kilometer,
            'status' => $request->status,
            'image_url' => $imageName,
            'image_url2' => $imageUrl2Name,
            'image_url3' => $imageUrl3Name,
            'image_url4' => $imageUrl4Name,
            'image_url5' => $imageUrl5Name,
        ]);

        return redirect()->route('products.index')->with('berhasil', 'Data Produk Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $product = products::findOrFail($id);

        foreach (['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'] as $field) {
            if ($product->$field && file_exists(public_path('img/' . $product->$field))) {
                unlink(public_path('img/' . $product->$field));
            }
        }

        $product->delete();
        return redirect()->route('products.index')->with('berhasil', 'Data Produk Berhasil Dihapus');
    }

    private function saveImage(Request $request, $field, $suffix = '')
    {
        if ($request->hasFile($field)) {
            $filename = time() . $suffix . '.' . $request->file($field)->getClientOriginalExtension();
            $request->file($field)->move(public_path('img'), $filename);
            return $filename;
        }
        return null;
    }

    private function updateImage(Request $request, $product, $field, $dbField = null)
    {
        $dbField = $dbField ?: $field;
        if ($request->hasFile($field)) {
            if ($product->$dbField && file_exists(public_path('img/' . $product->$dbField))) {
                unlink(public_path('img/' . $product->$dbField));
            }
            return $this->saveImage($request, $field);
        }
        return $product->$dbField;
    }
}
