<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table='actividades';

    protected $fillable=[
      'comunicado', 'docente_id', 'id_grupo', 'created_at',
    ];

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
