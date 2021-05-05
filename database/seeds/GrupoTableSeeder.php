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
            array("A", "A1L2", 1),
            array("B", "A1L2", 2),
            array("A", "A2LA", 3),
            array("A", "A3L2", 3),
            array("B", "A3L2", 4),
            array("A", "A4L3", 1),
            array("A", "A5L3", 2),
            array("B", "A5L3", 3),
            array("A", "A6L5", 3),
            array("A", "ACA-0909", 4),
            array("B", "ACA-0909", 1),
            array("A", "A8L2", 2),
            array("A", "A9L1", 3),
            array("B", "A9L1", 4),
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
