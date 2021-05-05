<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_grupo', function (Blueprint $table) {
            $table->bigIncrements('id');
            //FOREIGN KEYS
            $table->bigInteger('idAlumno')->unsigned()->nullable();
            $table->foreign('idAlumno')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('idGrupo')->unsigned()->nullable();
            $table->foreign('idGrupo')->references('id')->on('grupo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_grupo');
    }
}
