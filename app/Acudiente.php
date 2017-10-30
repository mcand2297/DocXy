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

  public function estudiantes(){
    return $this->hasMany('\App\Estudiante');
  }
}
