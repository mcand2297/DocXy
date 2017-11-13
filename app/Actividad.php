<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table='actividades';

    protected $fillable=[
      'comunicado', 'docente_id', 'grupo_id', 'asignatura_id', 'created_at',
    ];

    public function asignatura(){
      return $this->belongsTo('App\Asignatura');
    }

    //una actividad pertenece a un grupo
    public function grupo(){
      return $this->belongsTo('App\Grupo');
    }

    //una actividad posee archivos
    public function archivos(){
      return $this->hasMany('App\Archivo');
    }

    //una actividad posee comentarios
    public function comentarios(){
      return $this->hasMany('App\Comentario');
    }
}
