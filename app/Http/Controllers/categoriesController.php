<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;  // Menggunakan model Category yang sesuai dengan tabel 'categories'
use Illuminate\Support\Facades\Redirect;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();  // Mengambil data dari tabel categories
        return view('categories.index', compact('categories'));  // Menampilkan view dengan data categories
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);  // Menemukan kategori berdasarkan ID
        return view('categories.show', compact('category'));  // Mengirimkan data kategori ke view
    }

    public function getCategories()
    {
        return Category::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');  // Menampilkan form untuk membuat kategori baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi form tanpa menggunakan unique
        $request->validate([
            'category_name' => 'required',  // Validasi nama kategori yang wajib diisi
            'description' => 'nullable',  // Deskripsi boleh kosong
        ]);

        // Menyimpan data kategori ke dalam tabel categories
        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with(['berhasil' => 'Data Kategori Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $category)
    {
        $category = Category::findOrFail($category);  // Menemukan kategori berdasarkan id
        return view('categories.edit', compact('category'));  // Menampilkan form edit kategori
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi form
        $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $id . ',category_id',  // Memperbolehkan kategori dengan ID yang sama
            'description' => 'nullable',
        ]);

        $category = Category::findOrFail($id);  // Menemukan kategori berdasarkan id
        $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with(['berhasil' => 'Data Kategori Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);  // Menemukan kategori berdasarkan id
        $category->delete();  // Menghapus kategori
        return redirect()->route('categories.index')->with(['berhasil' => 'Data Kategori Berhasil Dihapus']);
    }
}
