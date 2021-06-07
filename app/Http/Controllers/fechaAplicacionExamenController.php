<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\evaluacionDepartamental;
use App\Models\FechaAplicacionExamen;
use App\Models\Grupo;
use App\Models\materia_Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class fechaAplicacionExamenController extends Controller
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
    public function store($idMateriaEvaluacion, Request $request)
    {
        $idUser = Auth::user()->id;
        $idDocente = Docente::where('idUsuario', $idUser)->first()->id;
        $claveMateria = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first()->claveMat;
        $idEvaluacion = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first()->idEvaluacion;
        $gruposDocente = Grupo::where('claveMateria', $claveMateria)->where('idDocente', $idDocente)->orderBy('grupo', 'asc')->get();

        foreach($gruposDocente as $grupo){
            $aplicacion = "aplicacion".$grupo->id;
            $fechaAplicacion = new FechaAplicacionExamen();
            $fechaAplicacion->idMatEv = $idMateriaEvaluacion;
            $fechaAplicacion->idGrupo = $grupo->id;
            $fechaAplicacion->fechaAplicacion = $request->$aplicacion;
            $fechaAplicacion->save();
        }

        return redirect()->route('consultarMateriasDocente', $idEvaluacion);
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
        $gruposDocente = Grupo::where('claveMateria', $claveMateria)->where('idDocente', $idDocente)->orderBy('grupo', 'asc')->get();
        $grupos= $gruposDocente->pluck('id');

        foreach($gruposDocente as $grupoDocente){
            $consultaFecha = FechaAplicacionExamen::where('idMatEv', $idMateriaEvaluacion)->where('idGrupo', $grupoDocente->id);
        //    if($consultaFecha->first()){
          $grupoDocente->fechaAplicacion = $consultaFecha->first()->fechaAplicacion;
        //    }
        //    else{
        //     $fechaAplicacionInicio = evaluacionDepartamental::where('id', $idEvaluacion)->first()->aplicacionInicio;
        //     $fechaAplicacionFin = evaluacionDepartamental::where('id', $idEvaluacion)->first()->aplicacionFin;
        //     return view("roles.docente.asignarFechaExamen", compact(
        //         "gruposDocente",
        //         'idMateriaEvaluacion',
        //         'fechaAplicacionInicio',
        //         'fechaAplicacionFin'
        //     ));
        //    }
            $grupoDocente->idFechaAplicacion = FechaAplicacionExamen::where('idMatEv', $idMateriaEvaluacion)->where('idGrupo', $grupoDocente->id)->first()->id;
        }

        $fechaAplicacionInicio = evaluacionDepartamental::where('id', $idEvaluacion)->first()->aplicacionInicio;
        $fechaAplicacionFin = evaluacionDepartamental::where('id', $idEvaluacion)->first()->aplicacionFin;
        return view("roles.docente.editarFechaExamen", compact(
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
    public function update($idMateriaEvaluacion, Request $request)
    {
        $idUser = Auth::user()->id;
        $idDocente = Docente::where('idUsuario', $idUser)->first()->id;
        $claveMateria = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first()->claveMat;
        $idEvaluacion = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first()->idEvaluacion;
      $gruposDocente = Grupo::where('claveMateria', $claveMateria)->where('idDocente', $idDocente)->orderBy('grupo', 'asc')->orderBy('id', 'asc')->get();

        foreach($gruposDocente as $grupo){
            $grupo->idFechaAplicacion = FechaAplicacionExamen::where('idMatEv', $idMateriaEvaluacion)->where('idGrupo', $grupo->id)->first()->id;

            $fechaId = "fechaId".$grupo->idFechaAplicacion;
            $aplicacion = "aplicacion".$grupo->id;
            $fechaExamen = FechaAplicacionExamen::find($request->$fechaId);
            $fechaExamen->fechaAplicacion = $request->$aplicacion;
            $fechaExamen->save();
        }
        return redirect()->route('consultarMateriasDocente', $idEvaluacion);
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
