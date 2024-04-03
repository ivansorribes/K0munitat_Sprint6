<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            abort(403, 'Unauthorized.');
        }

        // Obtener el usuario autenticado
        $user = auth()->user();

        // Verificar si el usuario tiene el rol de administrador
        if ($user->role !== 'superAdmin') {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
