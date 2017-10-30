<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table='mensajes';

    protected $fillable=[
      'texto', 'chat_id', 'docente_id','acudiente_id','created_at',
    ];

    //un mensaje hace parte de un chat
    public function chat(){
      return $this->belongsTo('App\Chat');
    }
}
