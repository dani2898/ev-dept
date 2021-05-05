<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $grupoArray = array(
            array("A", "SCA-1025", 2),
            array("B", "SCA-1025", 3),
            array("A", "SCD-1011", 2),
            array("B", "SCD-1011", 2)
        );

        foreach ($grupoArray as $grupoElement) {
            $grupo = new Grupo();
            $grupo->grupo = $grupoElement[0];
            $grupo->claveMateria = $grupoElement[1];
            $grupo->idDocente = $grupoElement[2];
            $grupo->save();
        }
    }
}
