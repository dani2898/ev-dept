<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('grupo');
            
            //FOREIGN KEYS
            $table->string('claveMateria')->unsigned()->nullable();
            $table->foreign('claveMateria')->references('claveMat')->on('materias')->onDelete('cascade');

            $table->bigInteger('idDocente')->unsigned()->nullable();
            $table->foreign('idDocente')->references('id')->on('docente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo');
    }
}
