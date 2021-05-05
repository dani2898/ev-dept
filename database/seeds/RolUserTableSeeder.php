<?php

namespace Database\Seeders;

use App\Models\RolUser;
use Illuminate\Database\Seeder;

class RolUserTableSeeder extends Seeder
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
            array(1, 1),
            array(2, 2),
            array(3, 3),
            array(3, 4),
            array(4, 5),
            array(4, 6)
        );

        foreach ($array as $element) {
            $rolUser = new RolUser();
            $rolUser->rol_id = $element[0];
            $rolUser->user_id = $element[1];
            $rolUser->save();
        }
    }
}
