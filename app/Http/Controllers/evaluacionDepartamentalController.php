<?php

namespace App\Http\Controllers;

use App\Models\evaluacionDepartamental;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class evaluacionDepartamentalController extends Controller
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

    public function test()
    {
       echo evaluacionDepartamental::all();
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

        // Array de meses
        $meses = collect([
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ]);

        // Sacamos mes y año de aplicacion de examen
        $month = date('m', strtotime($request->inicioAplicacion));
        $year = date('Y', strtotime($request->inicioAplicacion));

        //Nombre de la evaluación
        $nombre = "EvaluacionDepartamental" . ($meses[$month - 1]) . ($year);

        //obtener status
        $today = date("Y-m-d");

        $statusId = $this->obtenerStatus($today, $request);

        //id del status
        $evDept = evaluacionDepartamental::create([
            'nombre' => $nombre, 'mes' => $month, 'anio' => $year,
            'fechaRecoleccionInicio' => $request->inicioRecoleccion, 'fechaRecoleccionFin' => $request->finRecoleccion,
            'aplicacionInicio' => $request->inicioAplicacion, 'aplicacionFin' => $request->finAplicacion,
            'idStatus' => $statusId
        ]);

        $idEvDept = $evDept->id;
        // return view("roles.jefeDocencia.seleccionMaterias", compact("idEvDept"));
        return redirect()->route('obtenerMaterias', ['idEvaluacion' => $idEvDept]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\evaluacionDepartamental  $evaluacionDepartamental
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $evaluaciones = DB::table('ev_dept')
            ->join('status', 'ev_dept.idStatus', '=', 'status.id')
            ->select('ev_dept.*', 'status.status')
            ->orderBy('ev_dept.id', 'asc')
            ->get();

        return view("roles.jefeDocencia.listadoEvaluaciones", compact("evaluaciones"));
    }


    public function showEnCaptura()
    {
        ($evaluaciones = DB::table('ev_dept')
            ->join('status', 'ev_dept.idStatus', '=', 'status.id')
            ->select('ev_dept.*', 'status.status')
            ->orderBy('ev_dept.id', 'asc')
            ->where('status.id', "status2")
            ->get());

        return view("roles.docente.listadoEvaluaciones", compact("evaluaciones"));
    }

    public function showAplicando()
    {
        ($evaluaciones = DB::table('ev_dept')
            ->join('status', 'ev_dept.idStatus', '=', 'status.id')
            ->select('ev_dept.*', 'status.status')
            ->orderBy('ev_dept.id', 'asc')
            ->where('status.id', "status3")
            ->get());

        return view("roles.alumno.listadoEvaluaciones", compact("evaluaciones"));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\evaluacionDepartamental  $evaluacionDepartamental
     * @return \Illuminate\Http\Response
     */
    public function edit(evaluacionDepartamental $evaluacionDepartamental)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\evaluacionDepartamental  $evaluacionDepartamental
     * @return \Illuminate\Http\Response
     */
    public function update($idEvaluacion, Request $request)
    {  // Array de meses
        $meses = collect([
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ]);

        // Sacamos mes y año de aplicacion de examen
        $month = date('m', strtotime($request->inicioAplicacion));
        $year = date('Y', strtotime($request->inicioAplicacion));

        //Nombre de la evaluación
        $nombre = "EvaluacionDepartamental" . ($meses[$month - 1]) . ($year);

        //obtener status
        $today = date("Y-m-d");

        $statusId = $this->obtenerStatus($today, $request);

        $evaluacionDepartamental = evaluacionDepartamental::find($idEvaluacion);
        $evaluacionDepartamental->nombre = $nombre;
        $evaluacionDepartamental->mes = $month;
        $evaluacionDepartamental->anio = $year;
        $evaluacionDepartamental->fechaRecoleccionInicio = $request->inicioRecoleccion;
        $evaluacionDepartamental->fechaRecoleccionFin = $request->finRecoleccion;
        $evaluacionDepartamental->aplicacionInicio = $request->inicioAplicacion;
        $evaluacionDepartamental->aplicacionFin = $request->finAplicacion;
        $evaluacionDepartamental->idStatus = $statusId;
        $evaluacionDepartamental->save();

        return redirect()->route('listadoEvaluaciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\evaluacionDepartamental  $evaluacionDepartamental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        print($idEvaluacion = $request->idEvaluacion);
        $evaluacion = evaluacionDepartamental::find($idEvaluacion);
        $evaluacion->delete();

        return redirect()->route('listadoEvaluaciones');
    }


    public function obtenerStatus(String $fechaActual, Request $request)
    {

        switch ($fechaActual) {
            case ($fechaActual < $request->inicioRecoleccion):
                $statusId = "status1";
                return $statusId;
                break;

            case (($fechaActual >$request->finRecoleccion) && ($fechaActual < $request->inicioAplicacion)):
                $statusId = "status5";
                return $statusId;
                break;

            case (($fechaActual >= $request->inicioRecoleccion) && ($fechaActual <= $request->finRecoleccion)):
                $statusId = "status2";
                return $statusId;
                break;

            case (($fechaActual >= $request->inicioAplicacion) && ($fechaActual <=$request->finAplicacion)):
                $statusId = "status3";
                return $statusId;
                break;

            case ($fechaActual >=$request->finAplicacion):
                $statusId = "status4";
                return $statusId;
                break;
        }
    }

    public function redirectEv(Request $request)
    {
        $idEvaluacion = $request->idEvaluacion;
        $evaluacion = evaluacionDepartamental::find($idEvaluacion);

        return view('roles.jefeDocencia.opcionesEvaluacion', compact("evaluacion"));
    }

    public function redirectOpciones(Request $request)
    {
        $idEvDept = $request->idEvaluacion;
        if ($request->opciones == "01Opcion") {
            return redirect()->route('materiasEnCaptura', ['idEvaluacion' => $idEvDept]);
        } else if ($request->opciones == "02Opcion") {
            return redirect()->route('reporte', ['idEvaluacion' => $idEvDept]);
        }
    }

    public function obtenerDatosEvaluacion($idEvaluacion)
    {
        $idEvaluacion;

        $evaluacionDepartamental = evaluacionDepartamental::find($idEvaluacion);

        return view('roles.jefeDocencia.editarEvaluacion', compact("evaluacionDepartamental"));
    }
}
