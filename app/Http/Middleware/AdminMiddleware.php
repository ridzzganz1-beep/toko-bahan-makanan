<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        if (auth()->user()->role !== 'admin') {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
