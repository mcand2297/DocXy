<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table='actividades';

    protected $fillable=[
      'comunicado', 'id_docente', 'id_grupo', 'created_at',
    ];
}
