<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaEvaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_evaluacion', function (Blueprint $table) {
            $table->id();
             //Foreign key
            
             $table->string('claveMat')->unsigned()->nullable();
             $table->foreign('claveMat')->references('claveMat')->on('materias')->onDelete('cascade');

              //Foreign key
            
            $table->bigInteger('idEvaluacion')->unsigned()->nullable();
            $table->foreign('idEvaluacion')->references('id')->on('ev_dept')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia_evaluacion');
    }
}
