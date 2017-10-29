<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AsignaturaDocente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      chema::create('asignatura_docente', function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_asignatura')->unsigned();
          $table->integer('id_docente')->unsigned();

          $table->foreign('id_asignatura')->references('id')->on('asignaturas')->onDelete('cascade');
          $table->foreign('id_docente')->references('id')->on('docentes')->onDelete('cascade');

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
        Schema::dropIfExists('asignatura_docente');
    }
}
