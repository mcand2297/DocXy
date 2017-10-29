<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocenteGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('docente_grupo', function(Blueprint $table){
          $table->increments('id');
          $table->boolean('responsable')->default(false);
          $table->integer('id_docente')->unsigned();
          $table->integer('id_grupo')->unsigned();

          $table->foreign('id_docente')->references('id')->on('docentes')->onDelete('cascade');
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
        Schema::dropIfExists('docente_grupo');
    }
}
