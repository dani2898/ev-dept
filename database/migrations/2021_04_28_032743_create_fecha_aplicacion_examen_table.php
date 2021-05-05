<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFechaAplicacionExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechaAplicacionExamen', function (Blueprint $table) {
            $table->bigIncrements('id');
            //FOREIGN KEYS
            $table->bigInteger('idMatEv')->unsigned()->nullable();
            $table->foreign('idMatEv')->references('id')->on('materia_evaluacion')->onDelete('cascade');

            $table->bigInteger('idGrupo')->unsigned()->nullable();
            $table->foreign('idGrupo')->references('id')->on('grupo')->onDelete('cascade');

            $table->date('fechaAplicacion');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fechaAplicacionExamen');
    }
}
