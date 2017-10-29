<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='mensajes';

    protected $fillable=[
      'texto', 'id_chat', 'created_at',
    ];
}
