<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoExamen extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'resultado_examen';
    protected $fillable = ['respuesta', 'totalPreguntas', 'noAciertos', 'calificacion', 'aprobado', 'idExamen', 'idAlumnoGrupo','claveMat'];

    public function materias()
    {

        return $this->belongsTo(Materia::class, 'claveMat', 'claveMat');
    }

    public function alumno()
    {

        return $this->belongsTo(User::class, 'idAlumno', 'id');
    }
}
