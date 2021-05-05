<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'carreras';
    protected $fillable = ['claveCarrera', 'carrera'];
    protected $primaryKey = 'claveCarrera';
}
