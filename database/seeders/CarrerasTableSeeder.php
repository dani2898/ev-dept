<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarrerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carrerasArray = array(
            array("ITIC-2010-224", "Ingeniería en Tecnología y Comunicación"),
            array("IIF-2010-224", "Ingeniería Informática")

        );

        foreach ($carrerasArray as $carreraElement) {
            $carrera = new Carrera();
            $carrera->claveCarrera = $carreraElement[0];
            $carrera->carrera = $carreraElement[1];
            $carrera->save();
        }
    }
}
