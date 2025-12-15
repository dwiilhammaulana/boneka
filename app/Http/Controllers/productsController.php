<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\Category;
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
        $product = products::with('category')->findOrFail($id);

        $relatedProducts = products::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->take(4)
            ->get();

        return view('public.product', compact('product', 'relatedProducts'));
    }

    public function show($id)
    {
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
            'sku' => 'nullable|string|max:100',
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',

            'image' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'image4' => 'nullable|image|max:2048',
            'image5' => 'nullable|image|max:2048',
        ]);

        // Harga jual setelah diskon
        $hargaJual = $request->price - (($request->discount / 100) * $request->price);

        // Upload gambar
        $imageName  = $this->saveImage($request, 'image', '');
        $image2Name = $this->saveImage($request, 'image2', '_2');
        $image3Name = $this->saveImage($request, 'image3', '_3');
        $image4Name = $this->saveImage($request, 'image4', '_4');
        $image5Name = $this->saveImage($request, 'image5', '_5');

        products::create([
            'sku' => $request->sku,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'harga_jual' => $hargaJual,
            'stock' => $request->stock,
            'description' => $request->description,

            'image_url'  => $imageName,
            'image_url2' => $image2Name,
            'image_url3' => $image3Name,
            'image_url4' => $image4Name,
            'image_url5' => $image5Name,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
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
            'sku' => 'nullable|string|max:100',
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',

            'image' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'image4' => 'nullable|image|max:2048',
            'image5' => 'nullable|image|max:2048',
        ]);

        $product = products::findOrFail($id);

        // Hitung harga jual
        $hargaJual = $request->price - (($request->discount / 100) * $request->price);

        // Update gambar
        $imageName  = $this->updateImage($request, $product, 'image', 'image_url');
        $image2Name = $this->updateImage($request, $product, 'image2', 'image_url2');
        $image3Name = $this->updateImage($request, $product, 'image3', 'image_url3');
        $image4Name = $this->updateImage($request, $product, 'image4', 'image_url4');
        $image5Name = $this->updateImage($request, $product, 'image5', 'image_url5');

        $product->update([
            'sku' => $request->sku,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'harga_jual' => $hargaJual,
            'stock' => $request->stock,
            'description' => $request->description,

            'image_url'  => $imageName,
            'image_url2' => $image2Name,
            'image_url3' => $image3Name,
            'image_url4' => $image4Name,
            'image_url5' => $image5Name,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = products::findOrFail($id);

        foreach (['image_url','image_url2','image_url3','image_url4','image_url5'] as $field) {
            if ($product->$field && file_exists(public_path('img/'.$product->$field))) {
                unlink(public_path('img/'.$product->$field));
            }
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
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

    private function updateImage(Request $request, $product, $field, $dbField)
    {
        if ($request->hasFile($field)) {
            if ($product->$dbField && file_exists(public_path('img/' . $product->$dbField))) {
                unlink(public_path('img/' . $product->$dbField));
            }
            return $this->saveImage($request, $field);
        }
        return $product->$dbField;
    }
}
