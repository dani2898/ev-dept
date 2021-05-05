<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'rol_user';
    protected $fillable = ['rol_id', 'user_id'];

    

}
