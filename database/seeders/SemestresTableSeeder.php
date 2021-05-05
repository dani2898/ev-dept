<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Seeder;

class SemestresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            array(1, "Primer semestre"),
            array(2, "Segundo semestre"),
            array(3, "Segundo semestre"),
            array(4, "Segundo semestre"),
            array(5, "Segundo semestre"),
            array(6, "Segundo semestre"),
            array(7, "Segundo semestre"),
            array(8, "Segundo semestre"),
            array(9, "Segundo semestre"),
        );

        foreach ($array as $element) {
            $semestre = new Semestre();
            $semestre->semestre = $element[0];
            $semestre->descripcion = $element[1];
            $semestre->save();
        }
    }
}
