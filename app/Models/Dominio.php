<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dominio extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'dominio';
    protected $fillable = ['dominio', "descripcion"];
}
