<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDominioIdToPreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pregunta', function (Blueprint $table) {
            $table->bigInteger('idDominio')->unsigned()->nullable();
            $table->foreign('idDominio')->references('id')->on('dominio')->onDelete('cascade');
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
