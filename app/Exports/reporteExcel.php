<?php

namespace App\Exports;

use App\Models\Materia;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class reporteExcel implements  WithMultipleSheets
{
    use Exportable;

    protected $idEvaluacion;
    
    public function __construct(Int $idEvaluacion)
    {
        $this->idEvaluacion = $idEvaluacion;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets=[];
        $titulos = ["PROFESORES", "GRUPO", "MATERIA", "DEPARTAMENTAL", "SOBRESALIENTES", "EXCELENTES"];

        for ($sheet = 0; $sheet <sizeof($titulos); $sheet++) {
            $sheets[]=new sheet( $titulos[$sheet], $this->idEvaluacion);
        }

        return $sheets;
    }
}