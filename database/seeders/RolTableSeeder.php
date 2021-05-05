<?php

namespace Database\Seeders;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rolArray = array("Jefe Docencia", "Servidor Social", "Docente", "Alumno");

        foreach ($rolArray as $rolElemento) {
            $rol = new Rol();
            $rol->rol = $rolElemento;
            $rol->save();
        }
    }
}
