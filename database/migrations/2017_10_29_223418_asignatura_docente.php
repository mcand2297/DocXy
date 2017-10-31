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
      Schema::create('asignatura_docente', function(Blueprint $table){
          $table->increments('id');
          $table->integer('asignatura_id')->unsigned();
          $table->integer('docente_id')->unsigned();

          $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');
          $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');

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
