<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DocentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(3, 4);

        foreach ($array as $element) {
            $docente = new Docente();
            $docente->idUsuario =$element;
            $docente->save();
        }
    }
}
