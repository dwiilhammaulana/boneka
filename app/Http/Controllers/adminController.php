<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\admin;  // Menggunakan model Admin yang sesuai dengan tabel 'admin'
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = admin::orderBy('created_at', 'DESC')->get();  // Mengambil data dari tabel admin
        return view('admin.index', compact('admins'));  // Menampilkan view dengan data admin
    }

    public function show(string $id)
    {
        $admin = Admin::findOrFail($id);  // Menemukan admin berdasarkan id
        return view('admin.show', compact('admin'));  // Pastikan view yang dipanggil adalah 'admin.show'
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');  // Menampilkan form untuk membuat admin baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi form tanpa menggunakan unique
        $request->validate([
            'username' => 'required',  // Validasi username yang wajib diisi
            'password' => 'required',  // Validasi password yang wajib diisi
            'email' => 'nullable|email',  // Validasi email (opsional)
            'full_name' => 'nullable',  // Nama lengkap opsional
            'phone_number' => 'nullable',  // Nomor telepon opsional
        ]);

        // Menyimpan data admin ke dalam tabel admin
        Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),  // Enkripsi password
            'email' => $request->email,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.index')->with(['berhasil' => 'Data Admin Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);  // Menemukan admin berdasarkan id
        return view('admin.edit', compact('admin'));  // Menampilkan form edit admin
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi form
        $request->validate([
            'username' => 'required|unique:admin,username,' . $id . ',admin_id',  // Memperbolehkan admin dengan ID yang sama
            'password' => 'nullable',  // Password opsional
            'email' => 'nullable|email',
            'full_name' => 'nullable',
            'phone_number' => 'nullable',
        ]);

        $admin = Admin::findOrFail($id);  // Menemukan admin berdasarkan id

        // Update data admin
        $admin->update([
            'username' => $request->username,
            'password' => $request->password ? bcrypt($request->password) : $admin->password,  // Update password jika diisi
            'email' => $request->email,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.index')->with(['berhasil' => 'Data Admin Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);  // Menemukan admin berdasarkan id
        $admin->delete();  // Menghapus admin
        return redirect()->route('admin.index')->with(['berhasil' => 'Data Admin Berhasil Dihapus']);
    }

public function logout()
{
    // Logout dari guard admin (bisa diganti dengan Auth::logout() jika pakai default)
    Auth::guard('admin')->logout();

    // Hapus semua data sesi
    session()->flush();
    session()->invalidate();

    // Redirect ke halaman login (login/index.blade.php)
    return redirect()->route('login')->with('success', 'Berhasil logout');
}



}
