<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman Admin.');
        }

        if (auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses ditolak. Halaman tersebut hanya untuk Admin.');
    }
}
