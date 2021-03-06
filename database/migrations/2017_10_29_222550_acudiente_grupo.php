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
          $table->integer('acudiente_id')->unsigned();
          $table->integer('grupo_id')->unsigned();

          $table->foreign('acudiente_id')->references('id')->on('acudientes')->onDelete('cascade');
          $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');

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
