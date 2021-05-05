<?php

namespace Database\Seeders;

use App\Models\Materia;
use Illuminate\Database\Seeder;

class MateriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $array = array(
            array("AED-1285", "Fundamentos de Programacion", 1, "ISIC-2010-224"),
            array("AED-1286", "Programación Orientada a Objetos", 2, "ISIC-2010-224"),
            array("AED-1026", "Estructura de Datos", 3, "ISIC-2010-224"),
            array("SCD-1027", "Tópicos Avanzados de Programación", 4, "ISIC-2010-224"),
            array("SCA-1025", "Taller de Base de Datos", 5, "ISIC-2010-224"),
            array("SCD-1011", "Ingeniería de Software", 6, "ISIC-2010-224"),
            array("SCC-1023", "Sistemas Programables", 7, "ISIC-2010-224"),
            array("SCA-1002", "Administración de redes", 8, "ISIC-2010-224"),
            array("SCC-1012", "Inteligencia Articicial", 9, "ISIC-2010-224")
        );

        foreach ($array as $element) {
            $materia = new Materia();
            $materia->claveMat = $element[0];
            $materia->nombre = $element[1];
            $materia->idSemestre = $element[2];
            $materia->claveCarrera = $element[3];
            $materia->save();
        }
    }
}
