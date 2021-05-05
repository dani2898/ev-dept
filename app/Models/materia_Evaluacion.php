<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia_Evaluacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'materia_evaluacion';
    protected $fillable = ['claveMat', 'idEvaluacion'];

    public function materias()
    {

        return $this->belongsTo(Materia::class, 'claveMat', 'claveMat');
    }
}
