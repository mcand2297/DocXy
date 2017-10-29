<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->text('texto');
            $table->integer('id_docente')->unsigned()->default(0);
            $table->integer('id_acudiente')->unsigned()->default(0);
            $table->integer('id_actividad')->unsigned();

            $table->foreign('id_actividad')->references('id')->on('actividades')->onDelete('cascade');
            $table->foreign('id_docente')->references('id')->on('docentes');
            $table->foreign('id_acudiente')->references('id')->on('acudientes');

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
        Schema::dropIfExists('comentarios');
    }
}
