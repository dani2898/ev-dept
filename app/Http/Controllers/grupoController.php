<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\evaluacionDepartamental;
use App\Models\FechaAplicacionExamen;
use App\Models\Grupo;
use App\Models\materia_Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class grupoController extends Controller
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
    public function show($idMateriaEvaluacion)
    {
        $idUser = Auth::user()->id;
        $idDocente = Docente::where('idUsuario', $idUser)->first()->id;
        $claveMateria = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first()->claveMat;
        $idEvaluacion = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first()->idEvaluacion;

        $fechaAplicacionInicio = evaluacionDepartamental::where('id', $idEvaluacion)->first()->aplicacionInicio;
        $fechaAplicacionFin = evaluacionDepartamental::where('id', $idEvaluacion)->first()->aplicacionFin;

        

        $gruposDocente = Grupo::where('claveMateria', $claveMateria)->where('idDocente', $idDocente)->orderBy('grupo', 'asc')->get();
        $grupos= $gruposDocente->pluck('id');

        
        return view("roles.docente.asignarFechaExamen", compact(
            "gruposDocente",
            'idMateriaEvaluacion',
            'fechaAplicacionInicio',
            'fechaAplicacionFin'
        ));
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
