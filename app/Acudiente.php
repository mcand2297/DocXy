<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendant extends Model
{
  protected $table='acudientes';

  protected $fillable = [
      'nick', 'nombre', 'apellido',
      'email', 'password',
  ];
}
