<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcudienteGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('acudiente_grupo', function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_acudiente')->unsigned();
          $table->integer('id_grupo')->unsigned();

          $table->foreign('id_acudiente')->references('id')->on('acudientes')->onDelete('cascade');
          $table->foreign('id_grupo')->references('id')->on('grupos')->onDelete('cascade');

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
        Schema::dropIfExists('acudiente_grupo');
    }
}
