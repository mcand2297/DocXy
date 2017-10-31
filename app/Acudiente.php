<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acudiente extends Model
{
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

  //un acudiente participa en un chat
  public function chat(){
    return $this->belongsTo('App\Chat');
  }

  //un acudiente hace parte de una solicitud
  public function solicitud(){
    return $this->belongsTo('App\Solicitud');
  }
}
