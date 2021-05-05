<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('respuesta');
            $table->boolean('respuestaCorrecta');
            
            //Foreign keys

            $table->bigInteger('idPregunta')->unsigned()->nullable();
            $table->foreign('idPregunta')->references('id')->on('pregunta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuesta');
    }
}
