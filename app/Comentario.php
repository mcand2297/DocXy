<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
  protected $table='comentarios';

  protected $fillable = [
    'texto', 'docente_id', 'acudiente_id',
    'actividad_id', 'created_at',
  ];

  //un comentario hace parte de una actividad
  public function actividad(){
    return $this->belongsTo('App\Actividad');
  }
}
