<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) { // Jika belum login
            return redirect('login');
        }

        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            // Redirect ke halaman yang sesuai atau tampilkan error
            // Misalnya, redirect ke dashboard masing-masing role jika salah akses
            // Atau abort(403, 'UNAUTHORIZED ACTION.');
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
