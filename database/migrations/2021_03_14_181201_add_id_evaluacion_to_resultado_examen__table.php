<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdEvaluacionToResultadoExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resultado_examen', function (Blueprint $table) {
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
        Schema::table('resultado_examen', function (Blueprint $table) {
            //
        });
    }
}
