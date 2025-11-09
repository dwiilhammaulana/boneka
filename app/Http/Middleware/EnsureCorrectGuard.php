<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureCorrectGuard
{
    public function handle($request, Closure $next, $guard)
    {
        if (!Auth::guard($guard)->check()) {
            Auth::logout(); // Logout dari semua guard
            return redirect()->route("$guard.login");
        }

        return $next($request);
    }
}