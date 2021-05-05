<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JefeDocencia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    function handle($request, Closure $next, $role)
    {
        if (Auth::check() && $role == 'Jefe Docencia') {
            return $next($request);
        } elseif (Auth::check() && $role == 'Servidor Social') {
            return redirect('/servidor-social');
        } elseif (Auth::check() && $role == 'Docente') {
            return redirect('/docente');
        } else {
            return redirect('/alumno');
        }
    }
}
