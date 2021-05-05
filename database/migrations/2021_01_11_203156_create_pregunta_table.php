<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pregunta');

            //Foreign key
            
            $table->bigInteger('mat_ev_id')->unsigned()->nullable();
            $table->foreign('mat_ev_id')->references('id')->on('materia_evaluacion')->onDelete('cascade');

            $table->bigInteger('idTipoPregunta')->unsigned()->nullable();
            $table->foreign('idTipoPregunta')->references('id')->on('tipoPregunta')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregunta');
    }
}
