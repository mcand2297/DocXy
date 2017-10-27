<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('aceptado')->default(false);
            $table->string('codigo_ingreso');
            $table->integer('id_acudiente')->unsigned();
            $table->integer('id_grupo')->unsigned();

            $table->foreign('id_acudiente')->references('id')->on('attendants')->onDelete('cascade');
            $table->foreign('id_grupo')->references('id')->on('groups')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
