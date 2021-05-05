<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tema;

class TemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        



        $arrayTemas = array(
            array("Tema 1",  1, "A1L2"),
            array("Tema 2",  2, "A1L2"),
            array("Tema 1",  1, "A2LA"),
            array("Tema 2",  2, "A2LA"),
            array("Tema 1",  1, "A3L2"),
            array("Tema 2",  2, "A3L2"),
            array("Tema 1",  1, "A4L3"),
            array("Tema 2",  2, "A4L3"),
            array("Tema 1",  1, "A5L3"),
            array("Tema 2",  2, "A5L3"),
            array("Tema 1",  1, "A6L5"),
            array("Tema 2",  2, "A6L5"),
            array("Tema 1",  1, "ACA-0909"),
            array("Tema 2",  2, "ACA-0909"),
            array("Tema 1",  1, "A8L2"),
            array("Tema 2",  2, "A8L2"),
            array("Tema 1",  1, "A9L1"),
            array("Tema 2",  2, "A9L1"),
            
        );

        foreach ($arrayTemas as $elementTema) {
            $tema = new Tema();
            $tema->tema = $elementTema[0];
            $tema->unidad = $elementTema[1];
            $tema->claveMateria = $elementTema[2];
            $tema->save();
        }
    }
}
