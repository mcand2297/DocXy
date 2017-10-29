<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table='archivos';

    protected $fillable= [
      'nombre', 'data', 'extension',
      'id_actividad',
    ];
}
