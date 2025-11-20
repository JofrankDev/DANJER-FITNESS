<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsTrainer
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

        // Si el usuario NO es entrenador, redirigir al dashboard de cliente
        if ($user && !$user->trainer) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes acceso al dashboard de entrenadores.');
        }

        // Usuario es entrenador - permitir acceso
        return $next($request);
    }
}
