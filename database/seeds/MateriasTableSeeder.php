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
            array("A1L2", "Fundamentos de Programacion", 1, "ISIC-2010-224"),
            array("A2LA", "Programación Orientada a Objetos", 2, "ISIC-2010-224"),
            array("A3L2", "Estructura de Datos", 3, "ISIC-2010-224"),
            array("A4L3", "Tópicos Avanzados de Programación", 4, "ISIC-2010-224"),
            array("A5L3", "Taller de Base de Datos", 5, "ISIC-2010-224"),
            array("A6L5", "Ingeniería de Software", 6, "ISIC-2010-224"),
            array("ACA-0909", "Taller de investigación I", 7, "ISIC-2010-224"),
            array("A8L2", "Administración de redes", 8, "ISIC-2010-224"),
            array("A9L1", "Inteligencia Articicial", 9, "ISIC-2010-224")
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
