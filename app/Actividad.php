<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table='actividades';

    protected $fillable=[
      'comunicado', 'docente_id', 'id_grupo', 'created_at',
    ];
}
