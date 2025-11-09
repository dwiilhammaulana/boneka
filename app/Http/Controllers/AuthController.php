<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // View Registrasi Admin
    public function createAdmin()
    {
        return view('auth.register_admin');
    }

    // Proses Registrasi Admin
    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:admin|max:255',
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:8|confirmed',
            'full_name' => 'required',
            'phone_number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('login')->with('success', 'Admin berhasil didaftarkan');
    }

    // View Registrasi Customers
    public function createCustomer()
    {
        return view('auth.register_customer');
    }

    // Proses Registrasi Customers
    public function storeCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:customers|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:8|confirmed',
            'full_name' => 'required',
            'phone_number' => 'required|numeric',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        customers::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return redirect()->route('login')->with('success', 'Customer berhasil didaftarkan');
    }
}