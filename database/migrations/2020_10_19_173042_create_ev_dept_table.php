<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvDeptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_dept', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('mes');
            $table->string('anio');
            $table->date('fechaRecoleccionInicio');
            $table->date('fechaRecoleccionFin');
            $table->date('aplicacionInicio');
            $table->date('aplicacionFin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ev_dept');
    }
}
