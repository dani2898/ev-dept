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
            array("A", "SCA-1025", 1),
            array("B", "SCA-1025", 2),
            array("A", "SCD-1011", 1),
            array("B", "SCD-1011", 1)
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
