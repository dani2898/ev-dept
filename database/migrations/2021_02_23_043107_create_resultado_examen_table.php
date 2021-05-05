<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_examen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('respuestasAlumno');
            $table->integer('totalPreguntas');
            $table->integer('noAciertos');
            $table->integer('calificacion');
            $table->boolean('aprobado');

            //FOREIGN KEYS
            $table->bigInteger('idExamen')->unsigned()->nullable();
            $table->foreign('idExamen')->references('id')->on('examen')->onDelete('cascade');

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
        Schema::dropIfExists('resultado_examen');
    }
}
