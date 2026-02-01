<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pengecekan Login 
        if(!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda Harus Login Terlebih Dahulu');
        }

        // Pengecekan Role
        if(!in_array(auth()->user()->role_id, $roles)) {
            abort(403, 'Anda Tidak Memiliki Akses Ke Halaman Tersebut');
        }

        return $next($request);
    }
}
