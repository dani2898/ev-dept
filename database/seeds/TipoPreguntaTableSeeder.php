<?php

namespace Database\Seeders;

use App\Models\TipoPregunta;
use Illuminate\Database\Seeder;

class TipoPreguntaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoArray = array ("OPCION MÚLTIPLE", "VERDADERO O FALSO", "RELACIÓN COLUMNA"
          );

        foreach ($tipoArray as $tipoElemento) {
            $tipo = new TipoPregunta();
            $tipo->tipo = $tipoElemento;
            $tipo->save();
        }
        
    }
}
