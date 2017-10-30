<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

  class Archivo extends Model
{
    protected $table='archivos';

    protected $fillable= [
      'nombre', 'data', 'extension',
      'actividad_id',
    ];
}
