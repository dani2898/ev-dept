<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subtema;

class SubtemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arraySubtemas = array(
            array("Subtema 1",  1, "1"),
            array("Subtema 2",  2, "1"),
            array("Subtema 1",  1, "2"),
            array("Subtema 2",  2, "2"),
            array("Subtema 3",  3, "2"),
            array("Subtema 1",  1, "3"),
            array("Subtema 2",  2, "3"),
            array("Subtema 3",  1, "3"),
            array("Subtema 1",  2, "4"),
            array("Subtema 2",  3, "4")
            
        );

        foreach ($arraySubtemas as $elementSubtema) {
            $subtema = new Subtema();
            $subtema->subtema = $elementSubtema[0];
            $subtema->subUnidad = $elementSubtema[1];
            $subtema->idUnidad = $elementSubtema[2];
            $subtema->save();
        }
    }
}
