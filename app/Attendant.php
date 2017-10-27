<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendant extends Model
{
  protected $table='attendans';

  protected $fillable = [
      'nick', 'nombre', 'apellido',
      'email', 'password',
  ];
}
