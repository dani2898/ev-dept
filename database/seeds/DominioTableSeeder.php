<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dominio;

class DominioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayDominios = array(
            array("Cognoscitivo", "Los objetivos de aprendizaje se refieren a capacidades intelectuales de pensamiento."),
            array("Psicomotor", "Incluye los objetivos de aprendizaje relacionados con destrezas manuales."),
            array("Afectivo", "Son los objetivos de aprendizaje relacionados con la adquisición o cambio de valores, actitudes, apreciaciones e incluso estilos de vida.")
        );

        foreach ($arrayDominios as $dominioElement) {
            $dominio = new Dominio();
            $dominio->dominio = $dominioElement[0];
            $dominio->descripcion = $dominioElement[1];
            $dominio->save();
        }
    }
}
