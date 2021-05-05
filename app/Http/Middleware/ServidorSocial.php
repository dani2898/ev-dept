<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ServidorSocial
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
        if (Auth::check() && $role == 'Servidor Social') {
            return $next($request);
        } elseif (Auth::check() && $role == 'Docente') {
            return redirect('/docente');
        } elseif (Auth::check() && $role == 'Alumno') {
            return redirect('/alumno');
        } else {
            return redirect('/jefe-docencia');
        }
    }
}
