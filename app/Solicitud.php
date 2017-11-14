<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table='solicitudes';

    protected $fillable=[
      'aceptado', 'acudiente_id', 'grupo_id', 'created_at',
    ];

    //una solicitud la hace un acudiente
    public function acudiente(){
      return $this->belongsTo('App\Acudiente');
    }

    //una solicitud tiene el grupo al que se quiere ingresar
    public function grupo(){
      return $this->belongsTo('App\Grupo');
    }
}
