<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluacionDepartamental extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ev_dept';
    protected $fillable = ['nombre', 'mes', 'anio', 'fechaRecoleccionInicio', 
    'fechaRecoleccionFin', 'aplicacionInicio', 'aplicacionFin', 'idStatus', 'idDepartamento'];

}
