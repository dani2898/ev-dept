<?php

namespace App\Http\Controllers;

use App\Models\Dominio;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\materia_Evaluacion;
use App\Models\NivelDominio;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Subtema;
use App\Models\Tema;
use App\Models\TipoPregunta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class preguntaController extends Controller
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
        $preguntas = $request->all();
        $mat_ev_id = $preguntas['mat_ev_id'];
        foreach ($preguntas['arrayCapturas'] as $pregunta) {
            $flagCorrecta = true;
            $preguntaGuardar = new Pregunta();
            $preguntaGuardar->mat_ev_id = $preguntas['mat_ev_id'];
            $preguntaGuardar->idTipoPregunta = $preguntas['tipoPregunta'];
            $preguntaGuardar->pregunta = $pregunta['pregunta'];
            $preguntaGuardar->idDominio = $pregunta['dominio'];
            $preguntaGuardar->idTema = $pregunta['tema'];
            $preguntaGuardar->idSubtema = $pregunta['subtema'];
            $preguntaGuardar->idNivelDominio = $pregunta['nivelDominio'];
            $preguntaGuardar->habilitada = true;
            $preguntaGuardar->save();

            $idPregunta = $preguntaGuardar->id;
            if ($preguntas['tipoPregunta'] == 1 || $preguntas['tipoPregunta'] == 2) {
                foreach ($pregunta['respuestas'] as $respuesta) {
                    $respuestaGuardar = new Respuesta();
                    $respuestaGuardar->respuesta = $respuesta;
                    $respuestaGuardar->respuestaCorrecta = $flagCorrecta;
                    $respuestaGuardar->idPregunta = $idPregunta;
                    $respuestaGuardar->save();
                    $flagCorrecta = false;
                }
            } else {
                $respuestaGuardar = new Respuesta();
                $respuestaGuardar->respuesta = $pregunta['respuestas'];
                $respuestaGuardar->respuestaCorrecta = $flagCorrecta;
                $respuestaGuardar->idPregunta = $idPregunta;
                $respuestaGuardar->save();
            }
        }

        return response()->json(['url' => url("captura-materia/$mat_ev_id")]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idMateriaEvaluacion)
    {
        //
        $mat_ev_id = $idMateriaEvaluacion;
        $preguntasMateria = Pregunta::where('mat_ev_id', $idMateriaEvaluacion)->where('habilitada', true)->orderBy('id', 'ASC')->get();

        foreach ($preguntasMateria as $pregunta) {
            $pregunta->tipoPregunta = TipoPregunta::where('id', $pregunta->idTipoPregunta)->first()->tipo;
            $pregunta->dominio = Dominio::where('id', $pregunta->idDominio)->first()->dominio;
            $pregunta->tema = Tema::where('id', $pregunta->idTema)->first()->tema;
            $pregunta->respuestaCorrecta = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', true]])->first()->respuesta;
            $pregunta->respuestasIncorrectas = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', false]])->get('respuesta');
        }



        $tiposPregunta = TipoPregunta::orderBy('id', 'asc')->get();

        return view("roles.docente.listadoReactivos", compact("preguntasMateria", "mat_ev_id", 'tiposPregunta'));
    }


    public function showJefe($idMateriaEvaluacion)
    {
        //
        $mat_ev_id = $idMateriaEvaluacion;
        $preguntasMateria = Pregunta::where('mat_ev_id', $idMateriaEvaluacion)->where('habilitada', true)->get();

        foreach ($preguntasMateria as $pregunta) {
            $pregunta->tipoPregunta = TipoPregunta::where('id', $pregunta->idTipoPregunta)->first()->tipo;
            $pregunta->dominio = Dominio::where('id', $pregunta->idDominio)->first()->dominio;
            $pregunta->tema = Tema::where('id', $pregunta->idTema)->first()->tema;
            $pregunta->respuestaCorrecta = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', true]])->first()->respuesta;
            $pregunta->respuestasIncorrectas = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', false]])->get('respuesta');
        }


        $claveMat = materia_Evaluacion::where('id', $mat_ev_id)->first()->claveMat;
        $materia = Materia::where('claveMat', $claveMat)->first()->nombre;
        $grupos = Grupo::with('materias:claveMat,nombre')->where('claveMateria', $claveMat)->get();
        $idDocentes = $grupos->pluck('docentes.idUsuario');
        $docentes = User::whereIn('id', $idDocentes)->pluck('name');



        $tiposPregunta = TipoPregunta::all();

        return view("roles.jefeDocencia.listadoReactivos", compact(
            "preguntasMateria",
            "mat_ev_id",
            'tiposPregunta',
            'claveMat',
            'materia',
            'docentes'
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
    public function update($idPregunta, Request $request){

        $pregunta = Pregunta::find($idPregunta);
        $pregunta->pregunta = $request->pregunta;
        $pregunta->idTema = $request->tema;
        $pregunta->idSubtema = $request->subtema;
        $pregunta->idDominio = $request->dominio;
        $pregunta->idNivelDominio = $request->nivelDominio;
        $pregunta->save();

        if ($pregunta->idTipoPregunta == 1 ) {
            $respuestas = Respuesta::where('idPregunta', $pregunta->id)->orderBy('id', 'asc')->get();
            $inciso="A";

            foreach ($respuestas as $respuesta) {
                $stringInciso= "inciso".$inciso++;
               $respuesta->respuesta = $request->$stringInciso;
                $respuesta->save();
            }
        } elseif( $pregunta->idTipoPregunta == 2){
            $respuestaCorrecta=$request->verdaderoFalso;
            $respuestaIncorrecta="";
            if($respuestaCorrecta=="Verdadero"){
                $respuestaIncorrecta="Falso";
            }else{
                $respuestaIncorrecta="Verdadero";
            }
            $respuestaC = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', true]])->first(); 
            $respuestaC->respuesta = $respuestaCorrecta;
            $respuestaC->save();

            $respuestaI = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', false]])->first(); 
            $respuestaI->respuesta = $respuestaIncorrecta;
            $respuestaI->save();
        }else {
            $respuestaRelacionColumna = Respuesta::where('idPregunta', $pregunta->id)->first(); 
            $respuestaRelacionColumna->respuesta = $request->respuestaColumna;
            $respuestaRelacionColumna->save();
        } 
        return redirect()->route('verCapturasMateria', ['idMateriaEvaluacion' => $pregunta->mat_ev_id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPregunta, $idMateriaEvaluacion)
    {
        $pregunta = Pregunta::find($idPregunta);
        $pregunta->habilitada = false;
        $pregunta->save();

        return redirect()->route('verCapturasMateria', $idMateriaEvaluacion);
    }

    public function obtenerDatosPregunta($idPregunta, $idMateriaEvaluacion)
    {

        $pregunta = Pregunta::where('id', $idPregunta)->orderBy('id', 'ASC')->first();

        $pregunta->tipoPregunta = TipoPregunta::where('id', $pregunta->idTipoPregunta)->first()->tipo;
        $pregunta->dominio = Dominio::where('id', $pregunta->idDominio)->first()->dominio;
        $pregunta->tema = Tema::where('id', $pregunta->idTema)->first()->tema;
        $pregunta->respuestaCorrecta = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', true]])->first();
        $pregunta->respuestasIncorrectas = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', false]])->orderBy('id', 'asc')->get();

        $dominios = Dominio::all();
        $materia = materia_Evaluacion::where('id', $idMateriaEvaluacion)->first();
        $temas = Tema::where('claveMateria', $materia->claveMat)->get();
        $subtemas = Subtema::where('idUnidad', $pregunta->idTema)->get();
        $nivelDominios = NivelDominio::where('idDominio', $pregunta->idDominio)->get();
        $temasArray = $temas->pluck('id');
        $edit = true;
        //  echo $pregunta;
        //  exit;
        return view("roles.docente.editarPregunta", compact(
            "pregunta",
            "idMateriaEvaluacion",
            "dominios",
            "temas",
            "temasArray",
            "materia",
            "edit", 
            "subtemas",
            "nivelDominios"
        ));
    }

    public function bancoPreguntas($mat_ev_id)
    {
        $claveMat = materia_Evaluacion::where('id', $mat_ev_id)->first()->claveMat;

         $idMaterias = materia_Evaluacion::where([['claveMat', $claveMat], ['id', '!=', $mat_ev_id ]])->get('id');

         $preguntasMateria = Pregunta::whereIn('mat_ev_id', $idMaterias)->where('habilitada', true)->orderBy('id', 'asc')->get();

        foreach ($preguntasMateria as $pregunta) {
            $pregunta->tipoPregunta = TipoPregunta::where('id', $pregunta->idTipoPregunta)->first()->tipo;
            $pregunta->dominio = Dominio::where('id', $pregunta->idDominio)->first()->dominio;
            $pregunta->tema = Tema::where('id', $pregunta->idTema)->first()->tema;
            $pregunta->respuestaCorrecta = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', true]])->first()->respuesta;
            $pregunta->respuestasIncorrectas = Respuesta::where([['idPregunta', $pregunta->id], ['respuestaCorrecta', false]])->get('respuesta');
        }


        $claveMat = materia_Evaluacion::where('id', $mat_ev_id)->first()->claveMat;
        $materia = Materia::where('claveMat', $claveMat)->first()->nombre;
        $grupos = Grupo::with('materias:claveMat,nombre')->where('claveMateria', $claveMat)->get();
        $idDocentes = $grupos->pluck('docentes.idUsuario');
        $docentes = User::whereIn('id', $idDocentes)->pluck('name');



        $tiposPregunta = TipoPregunta::all();

        return view("roles.docente.bancoPreguntas", compact(
            "preguntasMateria",
            "mat_ev_id",
            'tiposPregunta',
            'claveMat',
            'materia',
            'docentes'
        ));
    }

    public function agregarReactivoBanco($mat_ev_id, $idReactivo)
    {
        echo $mat_ev_id;
        echo $idReactivo;

        $reactivo = Pregunta::where('id', $idReactivo)->first();
        $reactivo->mat_ev_id = $mat_ev_id;
        $reactivo->save();

        return redirect()->route('bancoPreguntas', $mat_ev_id);

    }
}
