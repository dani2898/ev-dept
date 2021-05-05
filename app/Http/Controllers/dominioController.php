<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dominio;
use App\Models\materia_Evaluacion;
use App\Models\Tema;
use App\Models\Subtema;

class dominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mat_ev_id, Request $request)
    {
        $tipoPregunta = $request->tipoPregunta;
        $dominios = Dominio::all();
        $materia = materia_Evaluacion::where('id', $mat_ev_id)->first();
        $temas = Tema::where('claveMateria', $materia->claveMat)->get();
        $temasArray = $temas->pluck('id');

        $subtemas = Subtema::whereIn('idUnidad',  $temasArray)->get();

        return view(
            "roles.docente.capturaReactivos",
            compact('dominios', 'temas', 'subtemas', 'mat_ev_id', 'tipoPregunta')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
