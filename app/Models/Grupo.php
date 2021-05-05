<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'grupo';
    protected $fillable = ['grupo', 'claveMateria', 'idDocente'];

    public function materias()
    {

        return $this->belongsTo(Materia::class, 'claveMateria', 'claveMat');
    }

    public function docentes()
    {

        return $this->belongsTo(Docente::class, 'idDocente', 'id');
    }

    
}


