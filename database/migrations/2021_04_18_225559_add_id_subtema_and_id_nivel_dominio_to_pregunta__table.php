<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSubtemaAndIdNivelDominioToPreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pregunta', function (Blueprint $table) {
            //

            $table->bigInteger('idSubtema')->unsigned()->nullable();
            $table->foreign('idSubtema')->references('id')->on('subtemas')->onDelete('cascade');

            $table->bigInteger('idNivelDominio')->unsigned()->nullable();
            $table->foreign('idNivelDominio')->references('id')->on('nivelDominio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregunta', function (Blueprint $table) {
            //
        });
    }
}
