<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'examen';
    protected $fillable = ['preguntas','mat_ev_id'];
}
