<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Si el usuario es entrenador, redirigir a su dashboard
        if ($user && $user->trainer) {
            return redirect()->route('trainer.dashboard')
                ->with('error', 'No tienes acceso al dashboard de clientes.');
        }

        // Si el usuario es administrador, permitir acceso (o redirigir según necesites)
        if ($user && $user->administrator) {
            // Por ahora permitimos que admin acceda al dashboard de cliente
            return $next($request);
        }

        // Usuario normal (cliente) - permitir acceso
        return $next($request);
    }
}
