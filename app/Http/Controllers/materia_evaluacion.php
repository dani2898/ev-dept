<?php

namespace App\Http\Controllers;

use App\Models\materia_Evaluacion as ModelsMateria_Evaluacion;
use App\Models\Grupo;
use App\Models\Docente;
use App\Models\Examen;
use App\Models\FechaAplicacionExamen;
use App\Models\Pregunta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;

class materia_evaluacion extends Controller
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
        $idEvDept = $request->idEvDept;
        $materias = $request->materias;


        if(isset($materias)){
            foreach ($materias as $materia) {
                $materiaEvaluacion = new ModelsMateria_Evaluacion();
                $materiaEvaluacion->claveMat = $materia;
                $materiaEvaluacion->idEvaluacion = $idEvDept;
                $materiaEvaluacion->save();
            }
        }
        
        return redirect()->route('listadoEvaluaciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idEvaluacion)
    {
        $materias = DB::table('materia_evaluacion')
            ->join('materias', 'materia_evaluacion.claveMat', '=', 'materias.claveMat')
            ->join('ev_dept', 'materia_evaluacion.idEvaluacion', '=', 'ev_dept.id')
            ->select('ev_dept.*', 'materias.*', 'materia_evaluacion.id as idMateriaEvaluacion')
            ->where('materia_evaluacion.idEvaluacion', '=', $idEvaluacion)
            ->orderBy('materias.claveMat', 'asc')
            ->get();
        $arrayNoPreguntas = [];
        
        foreach ($materias as $materia) {
            $preguntasMateria = Pregunta::where('mat_ev_id', $materia->idMateriaEvaluacion)->where('habilitada', true)->get();
            $preguntaConteo = $preguntasMateria->count();
            $materia->cantPreguntas = $preguntaConteo;
            $docentesId= Grupo::where('claveMateria', $materia->claveMat)->pluck('idDocente');
            $idUsuario = Docente::whereIn('id', $docentesId)->pluck('idUsuario'); 
            $materia->nombreDocentes = User::whereIn('id', $idUsuario)->pluck('name');
            $materia->opcionMultiple = Pregunta::where('mat_ev_id', $materia->idMateriaEvaluacion)->where('idTipoPregunta', 1)->where('habilitada', true)->get()->count();
            $materia->verdaderoFalso = Pregunta::where('mat_ev_id', $materia->idMateriaEvaluacion)->where('idTipoPregunta', 2)->where('habilitada', true)->get()->count();
            $materia->relacionColumna = Pregunta::where('mat_ev_id', $materia->idMateriaEvaluacion)->where('idTipoPregunta', 3)->where('habilitada', true)->get()->count();

            $examen = Examen::where('mat_ev_id', $materia->idMateriaEvaluacion)->get()->count();

            if($examen>0) $materia->examen = true;
            else   $materia->examen = false;
        }
// echo $materias; exit;
        return view("roles.jefeDocencia.materiasCaptura", compact("materias", 'idEvaluacion'));
    }

    public function showMateriasDocente($idEvaluacion)
    {
        //Obtenemos idDocente del usuario
        $idDocente = Docente::where('idUsuario', Auth::user()->id)
            ->select('docente.id')
            ->first();


        //Obtenemos lista de materias de Docente
        $materiasDocente = Grupo::where('idDocente', $idDocente->id)
            ->select('grupo.claveMateria')
            ->get();

        //Identificamos si el maestro da la misma materia, solo la recuperamos una vez
        $materiasDocente = $materiasDocente->unique('claveMateria');
        $materiasDocente->values()->all();
        $arrayMaterias = [];

        foreach ($materiasDocente as $elementoMateriasDocente) {
            $arrayMaterias[] = [$elementoMateriasDocente->claveMateria];
        }


        //Obtenemos la relación de las que están consideradas para la evaluación docente
        $materiasEvaluacionDocente = DB::table('materia_evaluacion')
            ->join('materias', 'materia_evaluacion.claveMat', '=', 'materias.claveMat')
            ->join('ev_dept', 'materia_evaluacion.idEvaluacion', '=', 'ev_dept.id')
            ->join('carreras', 'materias.claveCarrera', '=', 'carreras.claveCarrera')
            ->select('ev_dept.*', 'materias.*', 'carreras.*', 'materia_evaluacion.id as idMateriaEvaluacion')
            ->where('materia_evaluacion.idEvaluacion', '=', $idEvaluacion)
            ->whereIn('materia_evaluacion.claveMat',  $arrayMaterias)
            ->get();
        foreach($materiasEvaluacionDocente as $materia){
        $gruposDocente = Grupo::where('claveMateria', ($materia->claveMat))->where('idDocente', $idDocente->id)->orderBy('grupo', 'asc')->get();
        $grupos = $gruposDocente->pluck('id');
        $materia->fechaAplicacionFlag = FechaAplicacionExamen::whereIn('idGrupo', $grupos)->get();
        $preguntasMateria = Pregunta::where('mat_ev_id', $materia->idMateriaEvaluacion)->where('habilitada', true)->get();
            $preguntaConteo = $preguntasMateria->count();
            $materia->cantPreguntas = $preguntaConteo;
        }

        return view("roles.docente.listadoMaterias", compact("materiasEvaluacionDocente"));
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
    public function destroy($idMateriaEvaluacion, $idEvaluacion)
    {
        
        $deletedRows = ModelsMateria_Evaluacion::where('id', $idMateriaEvaluacion)->delete();

        return redirect()->route('materiasEnCaptura' , $idEvaluacion);

    }
}
