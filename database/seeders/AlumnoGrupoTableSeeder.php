<?php

namespace Database\Seeders;

use App\Models\AlumnoGrupo;
use Illuminate\Database\Seeder;

class AlumnoGrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alumnoGrupoArray = array(
            array(6, 1),
            array(6, 3),
            array(6, 4),
            array(6, 6),
            array(7, 1),
            array(7, 3),
            array(7, 11),
            array(7, 14),
            array(8, 2),
            array(8, 5),
            array(8, 8),
            array(8, 14),
            array(9, 2),
            array(9, 5),
            array(9, 8),
            array(9, 14)
        );

        foreach ($alumnoGrupoArray as $alumnoGrupoElement) {
            $alumnoGrupo = new AlumnoGrupo();
            $alumnoGrupo->idAlumno = $alumnoGrupoElement[0];
            $alumnoGrupo->idGrupo = $alumnoGrupoElement[1];
            $alumnoGrupo->save();
        }
    }
}
