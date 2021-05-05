<?php

namespace App\Http\Controllers;

use App\Exports\reporteExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class reporteController extends Controller
{
    
    public function generarReporte(Request $request)
    {
        $idEvaluacion = $request->idEvaluacion;
        // return Excel::download(new reporteExcel(), new reporteExcel(), 'users.xlsx');
        //  return Excel::dowknload(new reporteExcel(), 'reporteEvaluacionDepartamental.xlsx');
         return (new reporteExcel($idEvaluacion))->download('reporteGeneralEvaluacionesDepartamentales.xlsx');
    }
}
