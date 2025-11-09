<?php

namespace App\Http\Controllers;

use App\Models\customers;
use Illuminate\Http\Request;
use App\Models\admin;  // Jika Anda menggunakan model Admin
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah username untuk admin atau customer
        $admin = admin::where('username', $request->username)->first();
        $customer = customers::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin); // Gunakan guard 'admin'
            return redirect()->route('admin.index'); // Redirect ke dashboard admin
        }
        
        if ($customer && Hash::check($request->password, $customer->password)) {
            Auth::guard('customer')->login($customer); // Gunakan guard 'customer'
            return redirect()->route('public.home'); // Redirect ke dashboard customer
        }        

        // Jika login gagal
        return back()->withErrors(['username' => 'Username atau password salah']);
    }
}
