<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDominiosConteoToResultadoExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resultado_examen', function (Blueprint $table) {
            $table->integer('dominioCogniscitivo')->nullable();
            $table->integer('dominioPsicomotor')->nullable();
            $table->integer('dominioAfectivo')->nullable();
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
