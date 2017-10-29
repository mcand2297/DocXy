<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table='solicitudes';

    protected $fillable=[
      'aceptado', 'codigo_ingreso',
      'id_acudiente', 'id_grupo', 'created_at',
    ];
}
