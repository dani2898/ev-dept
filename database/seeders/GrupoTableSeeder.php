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
            1array("A", "A1L2", 1),
            2array("B", "A1L2", 2),
            3array("A", "A2LA", 3),
            4array("A", "A3L2", 3),
            5array("B", "A3L2", 4),
            6array("A", "A4L3", 1),
            7array("A", "A5L3", 2),
            8array("B", "A5L3", 3),
            9array("A", "A6L5", 3),
            10array("A", "ACA-0909", 4),
            11array("B", "ACA-0909", 1),
            12array("A", "A8L2", 2),
            13array("A", "A9L1", 3),
            14array("B", "A9L1", 4),
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
