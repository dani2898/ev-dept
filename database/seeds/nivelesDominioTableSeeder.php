<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NivelDominio;


class nivelesDominioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNiveles = array(
            array("Conocimiento",  1),
            array("Comprensión",  1),
            array("Aplicación",  1),
            array("Análisis",  1),
            array("Síntesis",  1),
            array("Evaluación",  1),
            array("Conocimiento",  2),
            array("Preparación",  2),
            array("Ejecución consciente",  2),
            array("Automatización",  2),
            array("Reorganización",  2),
            array("Recepción",  3),
            array("Respuesta",  3),
            array("Valorización",  3),
            array("Organización",  3),
            array("Caracterización",  3)
            
        );

        foreach ($arrayNiveles as $elementNiveles) {
            $nivel = new NivelDominio();
            $nivel->nivel = $elementNiveles[0];
            $nivel->idDominio = $elementNiveles[1];
            $nivel->save();
        }
    }
}
