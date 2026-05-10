<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk pelanggan.');
        }

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (auth()->user()->role !== 'user') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk pelanggan.');
        }

        return $next($request);
    }
}
