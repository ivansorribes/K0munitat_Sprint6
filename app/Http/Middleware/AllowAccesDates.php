<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowAccesDates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si la solicitud proviene de la aplicación React
        if ($request->header('Referer') && strpos($request->header('Referer'), config('app.react_url')) !== false) {
            return $next($request);
        }

        // Si no proviene de la aplicación React, responder con un error o redirigir
        return redirect('/');    }   
}
