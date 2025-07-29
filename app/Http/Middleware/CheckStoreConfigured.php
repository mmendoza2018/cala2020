<?php

namespace App\Http\Middleware;

use App\Models\General;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStoreConfigured
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        $store = General::first();

        $isConfigured = $store && $store->config_finished;

        $isConfigRoute = $request->routeIs('webpage.config_store');

        // Si NO está configurado, solo permitir la ruta de configuración
        if (!$isConfigured && !$isConfigRoute) {
            return redirect()->route('webpage.config_store');
        }

        // Si ya está configurado y quiere acceder a la ruta de configuración
        if ($isConfigured && $isConfigRoute) {
            return redirect()->route('webpage.home'); // o a donde tú prefieras
        }

        return $next($request);
    }
}
