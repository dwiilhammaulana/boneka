<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\customers;  // Menggunakan model customers yang sesuai dengan tabel 'customers'
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class customersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = customers::orderBy('created_at', 'DESC')->get();  // Mengambil data dari tabel customers
        return view('customers.index', compact('customers'));  // Menampilkan view dengan data customers
    }

    public function profile()
    {
        // Mendapatkan data pengguna yang sedang login
        $customer = Auth::guard('customer')->user();

        // Mengembalikan view untuk profil pengguna
        return view('public.profile', compact('customer'));
    }

    public function show($id)
    {
        $customer = customers::findOrFail($id);  // Menemukan customer berdasarkan ID
        return view('customers.show', compact('customer'));  // Mengirimkan data customer ke view
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');  // Menampilkan form untuk membuat customer baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'username' => 'required|unique:customers,username',  // Validasi username yang wajib diisi dan unik
            'password' => 'required',  // Validasi password yang wajib diisi
            'email' => 'nullable|email',  // Validasi email (jika diisi)
            'full_name' => 'required',  // Validasi nama lengkap yang wajib diisi
            'phone_number' => 'nullable',  // Validasi nomor telepon (jika diisi)
            'address' => 'nullable',  // Validasi alamat (jika diisi)
        ]);

        // Menyimpan data customer ke dalam tabel customers
        customers::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),  // Enkripsi password sebelum disimpan
            'email' => $request->email,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index')->with(['berhasil' => 'Data Customer Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cari data customer berdasarkan ID
        $customer = customers::find($id);

        // Jika data tidak ditemukan, tampilkan error atau redirect
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found.');
        }

        // Kirim data customer ke view
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // Validasi form
        $request->validate([
            'username' => 'required|unique:customers,username,' . $id . ',customer_id',  // Memperbolehkan username dengan ID yang sama
            'password' => 'nullable',  // Password boleh kosong, jika ingin diubah
            'email' => 'nullable|email',
            'full_name' => 'required',
            'phone_number' => 'nullable',
            'address' => 'nullable',
        ]);

        $customer = customers::findOrFail($id);  // Menemukan customer berdasarkan id
        $customer->update([
            'username' => $request->username,
            'password' => $request->password ? bcrypt($request->password) : $customer->password,  // Mengupdate password hanya jika diisi
            'email' => $request->email,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index')->with(['berhasil' => 'Data Customer Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = customers::findOrFail($id);  // Menemukan customer berdasarkan id
        $customer->delete();  // Menghapus customer
        return redirect()->route('customers.index')->with(['berhasil' => 'Data Customer Berhasil Dihapus']);
    }

    // Logout method
    public function logout(Request $request)
    {
        // Logout customer
        Auth::guard('customer')->logout();

        // Redirect ke halaman login atau halaman lain setelah logout
        return redirect()->route('public.home')->with('message', 'Anda telah berhasil logout.');
    }
}
