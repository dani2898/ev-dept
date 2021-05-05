<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToEvDept extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev_dept', function (Blueprint $table) {
            //Adding foreign key column status
            $table->string('idStatus')->unsigned()->nullable();
            $table->foreign('idStatus')->references('id')->on('status')->onDelete('cascade');

            //Adding foreign key column departamento
            $table->bigInteger('idDepartamento')->unsigned()->nullable();
            $table->foreign('idDepartamento')->references('id')->on('departamento')->onDelete('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev_dept', function (Blueprint $table) {
            //
        });
    }
}
