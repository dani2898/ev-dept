<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'respuesta';
    protected $fillable = ['respuesta', 'respuestaCorrecta', 'idPregunta'];
    
}
