<?php

namespace App\Http\Controllers;

use App\Models\AlumnoGrupo;
use App\Models\materia_Evaluacion as materiaEvaluacionModel;
use App\Models\Pregunta;
use App\Models\Examen;
use App\Models\FechaAplicacionExamen;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\materia_Evaluacion;
use App\Models\Respuesta;
use App\Models\ResultadoExamen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class examenController extends Controller
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
        $idEvaluacion = $request->idEvaluacionForm;
        $idMateriaEvaluacion = $request->idMateriaEvaluacionForm;
        $numeroPreguntas = ($request->opcionMultipleInput) + ($request->verdaderoFalsoInput) + ($request->relacionColumnaInput);

        $opcionMultiple = Pregunta::inRandomOrder()->limit($request->opcionMultipleInput)->where('mat_ev_id', $idMateriaEvaluacion)
            ->where('idTipoPregunta', 1)->get();
        $verdaderoFalso =  Pregunta::inRandomOrder()->limit($request->verdaderoFalsoInput)->where('mat_ev_id', $idMateriaEvaluacion)
            ->where('idTipoPregunta', 2)->get();
        $relacionColumna =  Pregunta::inRandomOrder()->limit($request->relacionColumnaInput)->where('mat_ev_id', $idMateriaEvaluacion)
            ->where('idTipoPregunta', 3)->get();

        $preguntas = $opcionMultiple->concat($verdaderoFalso)->concat($relacionColumna);
        foreach ($preguntas as $pregunta) {
            $arrayPreguntasId[] = $pregunta->id;
        }
        if (isset($arrayPreguntasId)) {
            $examen = new Examen;
            $examen->preguntas = json_encode($arrayPreguntasId);
            $examen->mat_ev_id = $idMateriaEvaluacion;
            $examen->save();
        }


        return redirect()->route('materiasEnCaptura', $idEvaluacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idEvaluacion)
    {
        $idAlumno = Auth::user()->id;

        $gruposAlumno = AlumnoGrupo::where('idAlumno', $idAlumno)->get()->pluck('idGrupo');

        $examenAplicadoGrupo = ResultadoExamen::where('idAlumno', $idAlumno)->get()->pluck('idGrupo');
        $gruposAlumno = AlumnoGrupo::where('idAlumno', $idAlumno)->whereNotIn('idGrupo', $examenAplicadoGrupo)->get()->pluck('idGrupo');
        $fechaActual = Carbon::now()->toDateString();
        $gruposAlumno = FechaAplicacionExamen::whereIn('idGrupo', $gruposAlumno)->where('fechaAplicacion', $fechaActual)->get()->sortBy('idGrupo')->pluck('idGrupo');


        $alumnoGrupo = AlumnoGrupo::where('idAlumno', $idAlumno)->get()->pluck('id');
        $examenesResueltos = ResultadoExamen::where([['idAlumno', $idAlumno], ['idEvaluacion', $idEvaluacion]])->get()->pluck('claveMat');
        $consultaGrupo = Grupo::whereIn('id', $gruposAlumno)->whereNotIn('claveMateria', $examenesResueltos)->get();
        $materias = $consultaGrupo->pluck('claveMateria');


        $materiaDatos = DB::table('materia_evaluacion')
            ->join('materias', 'materias.claveMat', '=', 'materia_evaluacion.claveMat')
            ->join('examen', 'examen.mat_ev_id', '=', 'materia_evaluacion.id')
            ->select('materia_evaluacion.id', 'materias.claveMat', 'materias.nombre')
            ->where('materia_evaluacion.idEvaluacion', '=', $idEvaluacion)
            ->whereIn('materia_evaluacion.claveMat',  $materias)
            ->get()->sortBy('id');
        $id = 0;
        foreach ($materiaDatos as $materia) {
            $materia->idGrupo = $gruposAlumno[$id];
            $id++;
        }



        return view("roles.alumno.listadoExamenes", compact("materiaDatos", 'idEvaluacion'));
    }

    public function showExamen($idMatEv, $idGrupo, $claveMat, $idEvaluacion)
    {
        $preguntas = Examen::where('mat_ev_id', $idMatEv)->first();
        $idExamen = $preguntas->id;
        $idPreguntas =  substr($preguntas->preguntas, 1);
        $arrayPreguntas = array_map('intval', explode(',', $idPreguntas));


        $opcionMultiple = Pregunta::whereIn('id', $arrayPreguntas)->where('idTipoPregunta', 1)->get();
        $verdaderoFalso = Pregunta::whereIn('id', $arrayPreguntas)->where('idTipoPregunta', 2)->get();
        $relacionPreguntas = Pregunta::whereIn('id', $arrayPreguntas)->where('idTipoPregunta', 3)->get();

        $idRelacionPregunta = $relacionPreguntas->pluck('id');
        foreach ($opcionMultiple as $pregunta) {
            $pregunta->respuesta = Respuesta::where('idPregunta', $pregunta->id)->inRandomOrder()->get();
        }

        foreach ($verdaderoFalso as $pregunta) {
            $pregunta->respuesta = Respuesta::where('idPregunta', $pregunta->id)->inRandomOrder()->get();
        }

        $relacionRespuestas = Respuesta::whereIn('idPregunta', $idRelacionPregunta)->inRandomOrder()->get();


        return view("roles.alumno.examen", compact(
            'opcionMultiple',
            'verdaderoFalso',
            'relacionPreguntas',
            'relacionRespuestas',
            'idMatEv',
            'idGrupo',
            'idExamen',
            'claveMat',
            'idEvaluacion'
        ));
    }

    public function showExamenJD($idMateriaEvaluacion)
    {
        $preguntas = Examen::where('mat_ev_id', $idMateriaEvaluacion)->first();
        $idExamen = $preguntas->id;
        $idPreguntas =  substr($preguntas->preguntas, 1);
        $arrayPreguntas = array_map('intval', explode(',', $idPreguntas));


        $opcionMultiple = Pregunta::whereIn('id', $arrayPreguntas)->where('idTipoPregunta', 1)->get();
        $verdaderoFalso = Pregunta::whereIn('id', $arrayPreguntas)->where('idTipoPregunta', 2)->get();
        $relacionPreguntas = Pregunta::whereIn('id', $arrayPreguntas)->where('idTipoPregunta', 3)->get();

        $idRelacionPregunta = $relacionPreguntas->pluck('id');
        foreach ($opcionMultiple as $pregunta) {
            $pregunta->respuesta = Respuesta::where('idPregunta', $pregunta->id)->inRandomOrder()->get();
        }

        foreach ($verdaderoFalso as $pregunta) {
            $pregunta->respuesta = Respuesta::where('idPregunta', $pregunta->id)->inRandomOrder()->get();
        }


        foreach ($relacionPreguntas as $pregunta) {
            $pregunta->respuesta = Respuesta::where('idPregunta', $pregunta->id)->first()->respuesta;
        }

        $claveMat = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first()->claveMat;
        $materia = Materia::where('claveMat', $claveMat)->first()->nombre;
        $grupos = Grupo::with('materias:claveMat,nombre')->where('claveMateria', $claveMat)->get();
        $idDocentes = $grupos->pluck('docentes.idUsuario');
        $docentes = User::whereIn('id', $idDocentes)->pluck('name');

        return view("roles.jefeDocencia.examen", compact(
            'opcionMultiple',
            'verdaderoFalso',
            'relacionPreguntas',
            'idMateriaEvaluacion',
            'claveMat',
            'materia',
            'docentes'
        ));
    }


    public function guardarRespuestasAlumno($idExamen, $idAlumnoGrupo, $claveMat, $idEvaluacion, Request $request)
    {
        $request->request->remove('_token');
        $arrayOpcionMultiple = array_filter(array_map('intval', explode(',', $request->arrayOpcionMultiple)));
        $arrayVerdaderoFalso = array_filter(array_map('intval', explode(',', $request->arrayVerdaderoFalso)));
        $arrayRelacionPreguntas = array_filter(array_map('intval', explode(',', $request->arrayRelacionPreguntas)));

        $arrayPreguntasGeneral = [];
        $arrayRespuestasGeneral = [];
        $respuestasAlumno = [];
        $totalPreguntas = count($arrayOpcionMultiple) + count($arrayVerdaderoFalso) + count($arrayRelacionPreguntas);
        $respuestasCorrectas = 0;
        $dominioCognoscitivo = 0;
        $dominioPsicomotor = 0;
        $dominioAfectivo = 0;

        foreach ($arrayOpcionMultiple as $opcionMultiple) {
            $arrayPreguntasGeneral[] = $opcionMultiple;
            $OMRespuesta = "OMRespuesta" . $opcionMultiple;
            $arrayRespuestasGeneral[] = $request->$OMRespuesta;
            $respuestasAlumno[] = $request->$OMRespuesta;
        }



        $idOpcionMultiple = Respuesta::whereIn('idPregunta', $arrayOpcionMultiple)
            ->whereIn('id', $respuestasAlumno)->where('respuestaCorrecta', true)->pluck('idPregunta');
        $respuestasCorrectas += count($idOpcionMultiple);


        $dominioCognoscitivo += count(Pregunta::where('idDominio', 1)->whereIn('id', $idOpcionMultiple)->get());
        $dominioPsicomotor += count(Pregunta::where('idDominio', 2)->whereIn('id', $idOpcionMultiple)->get());
        $dominioAfectivo += count(Pregunta::where('idDominio', 3)->whereIn('id', $idOpcionMultiple)->get());

        $respuestasAlumno = [];


        foreach ($arrayVerdaderoFalso as $verdaderoFalso) {
            $arrayPreguntasGeneral[] = $verdaderoFalso;
            $VFRespuesta = "VFRespuesta" . $verdaderoFalso;
            $arrayRespuestasGeneral[] = $request->$VFRespuesta;
            $respuestasAlumno[] = $request->$VFRespuesta;
        }

        $idPreguntaVerdaderoFalso = Respuesta::whereIn('idPregunta', $arrayVerdaderoFalso)
            ->whereIn('id', $respuestasAlumno)->where('respuestaCorrecta', true)->pluck('idPregunta');
        $respuestasCorrectas += count($idPreguntaVerdaderoFalso);


        $dominioCognoscitivo += count(Pregunta::where('idDominio', 1)->whereIn('id', $idPreguntaVerdaderoFalso)->get());
        $dominioPsicomotor += count(Pregunta::where('idDominio', 2)->whereIn('id', $idPreguntaVerdaderoFalso)->get());
        $dominioAfectivo += count(Pregunta::where('idDominio', 3)->whereIn('id', $idPreguntaVerdaderoFalso)->get());

        $respuestasAlumno = [];

        $relacionColumnaId = [];

        foreach ($arrayRelacionPreguntas as $relacionPreguntas) {
            $arrayPreguntasGeneral[] = $relacionPreguntas;
            $RRRespuesta = "RRRespuesta" . $relacionPreguntas;
            $arrayRespuestasGeneral[] = $request->$RRRespuesta;
            $respuestasAlumno[] = $request->$RRRespuesta;
            $idRespuesta = Respuesta::where('idPregunta', $relacionPreguntas)
                ->where('id', $request->$RRRespuesta)->first();
            if (!$idRespuesta == "") {
                $relacionColumnaId[] = $idRespuesta['idPregunta'];
            }
        }
        $respuestasCorrectas += count($relacionColumnaId);


        $dominioCognoscitivo += count(Pregunta::where('idDominio', 1)->whereIn('id', $relacionColumnaId)->get());
        $dominioPsicomotor += count(Pregunta::where('idDominio', 2)->whereIn('id', $relacionColumnaId)->get());
        $dominioAfectivo += count(Pregunta::where('idDominio', 3)->whereIn('id', $relacionColumnaId)->get());


        $calificacion = $this->generarCalificacion($respuestasCorrectas, $totalPreguntas);
        $aprueba = $this->apruebaExamen($calificacion);


        $resultadoExamen = new ResultadoExamen();
        $resultadoExamen->respuestasAlumno = json_encode($arrayRespuestasGeneral);
        $resultadoExamen->totalPreguntas = $totalPreguntas;
        $resultadoExamen->noAciertos = $respuestasCorrectas;
        $resultadoExamen->calificacion =  $calificacion;
        $resultadoExamen->aprobado = $aprueba;
        $resultadoExamen->idExamen = $idExamen;
        $resultadoExamen->idAlumno = Auth::user()->id;
        $resultadoExamen->idGrupo = $idAlumnoGrupo;
        $resultadoExamen->claveMat = $claveMat;
        $resultadoExamen->idEvaluacion = $idEvaluacion;
        $resultadoExamen->dominioCogniscitivo = $dominioCognoscitivo;
        $resultadoExamen->dominioPsicomotor = $dominioPsicomotor;
        $resultadoExamen->dominioAfectivo = $dominioAfectivo;
        $resultadoExamen->save();

        return redirect()->route('consultarExamenesAlumno', $idEvaluacion);
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
        Examen::where('mat_ev_id', $idMateriaEvaluacion)->delete();

        return redirect()->route('materiasEnCaptura', $idEvaluacion);
    }

    public function generarCalificacion(Int $respuestasCorrectas, Int $totalPreguntas)
    {
        $calificacion = ($respuestasCorrectas * 100) / $totalPreguntas;
        return ((int)$calificacion);
    }

    public function apruebaExamen(Int $calificacion)
    {
        $resultado = true;
        if ($calificacion < 70) {
            $resultado = false;
        }

        return $resultado;
    }
}
