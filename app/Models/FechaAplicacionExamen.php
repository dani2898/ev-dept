<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechaAplicacionExamen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'fechaAplicacionExamen';
    protected $fillable = ['idMatEv','idGrupo', 'fechaAplicacion'];
}
