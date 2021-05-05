<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'rol';
    protected $fillable = ['rol'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'rol_user')
            ->withPivot('user_id');
    }
}
