<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'peserta') {
            // kalau bukan peserta, lempar ke dashboard admin
            return redirect()->route('admin.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman peserta.');
        }

        return $next($request);
    }
}
