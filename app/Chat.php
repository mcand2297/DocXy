<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $table='chats';

  protected $fillable = ['acudiente_id', 'docente_id', ];

  //un chat tiene un docente
  public function docente(){
    return $this->hasOne('App\Docente');
  }

  //un chat tiene un acudiente
  public function acudiente(){
    return $this->hasOne('App\Acudiente');
  }

  //un chat posee varios mensajes
  public function mensajes(){
    return $this->hasMany('App\Mensaje');
  }

}
