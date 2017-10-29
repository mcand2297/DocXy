<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table='mensajes';

    protected $fillable=[
      'texto', 'id_chat', 'created_at',
    ];
}
