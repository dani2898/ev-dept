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
            array(5, 2 ),
            array(6, 3),
            array(5, 4),
        );

        foreach ($alumnoGrupoArray as $alumnoGrupoElement) {
            $alumnoGrupo = new AlumnoGrupo();
            $alumnoGrupo->idAlumno = $alumnoGrupoElement[0];
            $alumnoGrupo->idGrupo = $alumnoGrupoElement[1];
            $alumnoGrupo->save();
        }
    }
}
