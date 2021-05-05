<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        //Revisa que el usuario a ingresar cumpla con un determinado rol
        if ($request->user()->hasRole($role)) {
            return $next($request);
        }
        abort(403);
        
    }
}
