<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table="estudiantes";

    protected $fillable=['nombre', 'apellido', ];

    public function grupo(){
      return $this->belongsTo('\App\Grupo');
    }

    public function acudiente(){
      return $this->belongsTo('\App\Acudiente');
    }
}
