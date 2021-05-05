<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->string('claveMat')->primary();
            $table->string('nombre');
            
            //FOREIGN KEYS
            $table->bigInteger('idSemestre')->unsigned()->nullable();
            $table->foreign('idSemestre')->references('id')->on('semestre')->onDelete('cascade');

            $table->string('claveCarrera')->unsigned()->nullable();
            $table->foreign('claveCarrera')->references('claveCarrera')->on('carreras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
