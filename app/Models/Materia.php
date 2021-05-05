<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'materias';
    protected $fillable = ['claveMat', 'nombre', 'idSemestre', 'claveCarrera'];
    // public $primaryKey = 'claveMat';

    public function grupos()
    {
        
        return $this->hasMany(Grupo::class,'claveMateria', 'claveMat');


    }

    public function resultados()
    {
        
        return $this->hasMany(ResultadoExamen::class,'claveMat', 'claveMat');


    }
}
