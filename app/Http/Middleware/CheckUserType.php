<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $user = Auth::user();

            // Si el usuario tiene el user_type requerido
            if ($user->user_type === $role) {
                return $next($request);
            } else {
                // Si no tiene el user_type, redirigir a una página de acceso denegado o logout
                return redirect('/unauthorized');
            }
        }

        // Si no está autenticado, redirigir a login
        return redirect()->route('login');
    }
}
