<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AsignaturaDocenteGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('asignatura_docente_grupo', function(Blueprint $table){
          $table->increments('id');
          $table->boolean('responsable')->default(false);
          $table->integer('docente_id')->unsigned();
          $table->integer('grupo_id')->unsigned();
          $table->integer('asignatura_id')->unsigned();

          $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
          $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
          $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');

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
        Schema::dropIfExists('asignatura_docente_grupo');
    }
}
