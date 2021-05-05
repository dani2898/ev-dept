<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Alumno
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
        if (Auth::check() && $role == 'Alumno') {
            return $next($request);
        } elseif (Auth::check() && $role == 'Jefe Docencia') {
            return redirect('/jefe-docencia');
        } elseif (Auth::check() && $role == 'Servidor Social') {
            return redirect('/servidor-social');
        } else {
            return redirect('/docente');
        }
    }
}
