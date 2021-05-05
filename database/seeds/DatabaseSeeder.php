<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UserTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(SemestresTableSeeder::class);
        $this->call(CarrerasTableSeeder::class);
        $this->call(MateriasTableSeeder::class);
        $this->call(TemasTableSeeder::class);
        $this->call(SubtemasTableSeeder::class);
        $this->call(RolTableSeeder::class);
        $this->call(RolUserTableSeeder::class);
        $this->call(TipoPreguntaTableSeeder::class);
        $this->call(DocentesTableSeeder::class);
        $this->call(GrupoTableSeeder::class);
        $this->call(DominioTableSeeder::class);
        $this->call(AlumnoGrupoTableSeeder::class);
        $this->call(nivelesDominioTableSeeder::class);
    }
}
