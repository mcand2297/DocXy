<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table='mensajes';

    protected $fillable=[
      'texto', 'chat_id', 'created_at',
    ];
}
