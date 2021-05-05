<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Asignamos los usuarios a variables para crear los seeders de prueba

        $rol_jefe_docencia = Rol::where('rol', 'Jefe Docencia')->first();
        $rol_servidor_social = Rol::where('rol', 'Servidor Social')->first();
        $rol_docente = Rol::where('rol', 'Docente')->first();
        $rol_alumno = Rol::where('rol', 'Alumno')->first();

        $user = new User();
        $user->name = 'Aurelio Coria';
        $user->email = 'aurelio@gmail.com';
        $user->password = bcrypt('12345678');
        $user->username = 'JD0001';
        $user->save();
        $user->roles()->attach($rol_jefe_docencia);

        $user = new User();
        $user->name = 'Jessica Villa';
        $user->email = 'jess@gmail.com';
        $user->password = bcrypt('12345678');
        $user->username = 'SS0001';
        $user->save();
        $user->roles()->attach($rol_servidor_social);

        $user = new User();
        $user->name = 'Ireri Rojas';
        $user->email = 'ireri@gmail.com';
        $user->password = bcrypt('12345678');
        $user->username = 'D00001';
        $user->save();
        $user->roles()->attach($rol_docente);

        $user = new User();
        $user->name = 'Miguel Lara';
        $user->email = 'miguel@gmail.com';
        $user->password = bcrypt('12345678');
        $user->username = 'D00002';
        $user->save();
        $user->roles()->attach($rol_docente);
        
        $user = new User();
        $user->name = 'Daniela Villa';
        $user->email = 'daniela@gmail.com';
        $user->password = bcrypt('12345678');
        $user->username = 'A00001';
        $user->save();
        $user->roles()->attach($rol_alumno);

        $user = new User();
        $user->name = 'Isacc Carranza';
        $user->email = 'isacc@gmail.com';
        $user->password = bcrypt('12345678');
        $user->username = 'A00002';
        $user->save();
        $user->roles()->attach($rol_alumno);
    }
}
