<?php

namespace App\Http\Controllers;

use App\Models\AlumnoGrupo;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\materia_Evaluacion;
use App\Models\User;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class materiaController extends Controller
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
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materiasEvaluacion = materia_Evaluacion::where('idEvaluacion', $id)->pluck('claveMat');
        $materias = Materia::whereNotIn('claveMat', $materiasEvaluacion)->get();
        foreach($materias as $materia){
        $docentesId= Grupo::where('claveMateria', $materia->claveMat)->pluck('idDocente');
        $idUsuario = Docente::whereIn('id', $docentesId)->pluck('idUsuario'); 
        $materia->nombreDocentes = User::whereIn('id', $idUsuario)->pluck('name');

        $idGrupos = Grupo::where('claveMateria', $materia->claveMat)->pluck('id');
        $materia->noAlumnos = AlumnoGrupo::whereIn('idGrupo', $idGrupos)->count();
        }

        return view("roles.jefeDocencia.seleccionMaterias", compact("materias", "id"));
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
