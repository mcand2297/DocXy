<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Acudiente extends Authenticatable
{

  use Notifiable;

  protected $table='acudientes';

  protected $fillable = [
      'nick', 'nombre', 'apellido',
      'email', 'password',
  ];

  protected $hidden = [
      'password', 'remember_token',
  ];

  //un acudiente es responsable de varios estudiantes
  public function estudiantes(){
    return $this->hasMany('\App\Estudiante');
  }

  //un acudiente puede ser parte de varios grupos
  public function grupos(){
    return $this->belongsToMany('\App\Grupo');
  }

  public function comentarios(){
    return $this->hasMany('App\Comentario');
  }

  //un acudiente participa en un chat
  public function chats(){
    return $this->hasMany('App\Chat');
  }

  //un acudiente hace parte de una solicitud
  public function solicitudes(){
    return $this->hasMany('App\Solicitud');
  }
}
