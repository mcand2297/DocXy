<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

  class Archivo extends Model
{
    protected $table='archivos';

    protected $fillable= [
      'nombre', 'data', 'extension',
      'actividad_id',
    ];

    //un archivo hace parte de una actividad
    public function actividad(){
      return $this->belongsTo('App\Actividad');
    }
}
