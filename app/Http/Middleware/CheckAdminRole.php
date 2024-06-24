<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        // Check if the user is authenticated and has role = 2
        if (Auth::check() && Auth::user()->role == 2) {
            return $next($request);
        }

        // If the user doesn't have the right role, redirect to home page
        return redirect('/');
    }
}
