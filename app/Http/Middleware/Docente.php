<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Docente
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
        if (Auth::check() && $role == 'Docente') {
            return $next($request);
        } elseif (Auth::check() && $role == 'Alumno') {
            return redirect('/alumno');
        } elseif (Auth::check() && $role == 'Jefe Docencia') {
            return redirect('/jefe-docencia');
        } else {
            return redirect('/servidor-social');
        }
    }
}
