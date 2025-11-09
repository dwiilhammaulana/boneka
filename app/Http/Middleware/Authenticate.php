<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Cek apakah guard customer sudah login
        if (Auth::guard('customer')->check()) {
            return $next($request); // Lanjutkan jika sudah login sebagai customer
        }

        // Cek apakah guard admin sudah login
        if (Auth::guard('admin')->check()) {
            return $next($request); // Lanjutkan jika sudah login sebagai admin
        }

        // Jika belum login sebagai customer atau admin, arahkan ke halaman login
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
}
