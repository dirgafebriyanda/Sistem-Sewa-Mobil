<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
       // Periksa apakah pengguna masuk
    if (!Auth::check()) {
        return redirect('login');
    }

    // Periksa apakah peran pengguna cocok dengan peran yang diizinkan
    $user = Auth::user();
        if ($user->role == $roles) {
            return $next($request);
        }
        return redirect('/dashboard')->with('error', 'Unauthorized');
        
    }
}
