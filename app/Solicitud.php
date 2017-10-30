<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table='solicitudes';

    protected $fillable=[
      'aceptado', 'codigo_ingreso',
      'acudiente_id', 'grupo_id', 'created_at',
    ];
}
