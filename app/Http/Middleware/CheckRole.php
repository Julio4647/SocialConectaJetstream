<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Verificar si el usuario tiene el rol necesario
            if (Auth::user()->roles->pluck('name')->contains('admin')) {
                return $next($request);
            }
        }

         // Redirigir al usuario a la ruta de acceso denegado
         return redirect()->route('acceso-denegado');

    }
}
