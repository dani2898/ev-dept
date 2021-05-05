<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolUser;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        print($rol =  RolUser::where('user_id', Auth::user()->id)->get()->first());
         if (Auth::check() && $rol->rol_id == '1') {
              return redirect()->route('jefeDocencia');
         }
         elseif (Auth::check() && $rol->rol_id == '2') {
            return redirect()->route('servidorSocial');
         }
         elseif (Auth::check() && $rol->rol_id == '3') {
            return redirect()->route('docente');
        }
         else {
            return redirect()->route('alumno');
         }
    }

}
