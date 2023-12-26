<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->typeUser->type_user === 'superadmin') {
            return $next($request);
        }
        if (auth()->check()) {
            return redirect()->route('home')->with('error', 'Acceso no autorizado.');
        }
        return redirect()->route('welcome')->with('error', 'Acceso no autorizado.');
    }
}
