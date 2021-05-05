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
            array("Subtema 3",  1, "4"),
            array("Subtema 1",  2, "4"),
            array("Subtema 2",  3, "4"),
            array("Subtema 1",  1, "5"),
            array("Subtema 2",  2, "5"),
            array("Subtema 1",  1, "6"),
            array("Subtema 2",  2, "6"),
            array("Subtema 3",  3, "6"),
            array("Subtema 1",  1, "7"),
            array("Subtema 2",  2, "7"),
            array("Subtema 3",  1, "8"),
            array("Subtema 1",  2, "8"),
            array("Subtema 2",  3, "8"),
            array("Subtema 1",  1, "9"),
            array("Subtema 2",  2, "9"),
            array("Subtema 1",  1, "10"),
            array("Subtema 2",  2, "10"),
            array("Subtema 3",  3, "10"),
            array("Subtema 1",  1, "11"),
            array("Subtema 2",  2, "11"),
            array("Subtema 3",  1, "12"),
            array("Subtema 1",  2, "12"),
            array("Subtema 2",  3, "12"),
            array("Subtema 1",  1, "13"),
            array("Subtema 2",  2, "13"),
            array("Subtema 1",  1, "14"),
            array("Subtema 2",  2, "14"),
            array("Subtema 3",  3, "14"),
            array("Subtema 1",  1, "15"),
            array("Subtema 2",  2, "15"),
            array("Subtema 3",  1, "16"),
            array("Subtema 1",  2, "16"),
            array("Subtema 2",  3, "16"),
            array("Subtema 1",  1, "17"),
            array("Subtema 2",  2, "17"),
            array("Subtema 3",  1, "18"),
            array("Subtema 1",  2, "18"),
            array("Subtema 2",  3, "18"),
            
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
