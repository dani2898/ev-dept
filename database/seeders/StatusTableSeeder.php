<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Arreglo de status
        //Captura, aplicación, finalizado

        
        $statusArray = array (
            array("status1","Proceso iniciado"),
            array("status2","En captura"),
            array("status3","Aplicando"),
            array("status4","Finalizado"),
            array("status5","Procesando")
          );

        foreach ($statusArray as $statusElemento) {
            $status = new Status();
            $status->id = $statusElemento[0];
            $status->status = $statusElemento[1];
            $status->save();
        }
        
    }
}
