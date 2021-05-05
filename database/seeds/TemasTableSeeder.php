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
            array("Tema 1",  1, "SCD-1011"),
            array("Tema 2",  2, "SCD-1011"),
            array("Tema 1",  1, "SCA-1025"),
            array("Tema 2",  2, "SCA-1025"),
            
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
