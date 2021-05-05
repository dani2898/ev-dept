<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pregunta';
    protected $fillable = ['pregunta', 'mat_ev_id', 'idTipoPregunta', 'idDominio', 'idTema'];


    public function tipoPregunta()
    {
        return $this->belongsTo(tipoPregunta::class, 'idTipoPregunta');
    }

    public function dominio()
    {
        return $this->belongsTo(Dominio::class, 'idDominio');
    }

    public function tema()
    {
        return $this->belongsTo(Dominio::class, 'idTema');
    }

}
