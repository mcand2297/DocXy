<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table="estudiantes";

    protected $fillable=['nombre', 'apellido', 'grupo_id', 'acudiente_id'];

    //un estudiante hace parte de un grupo
    public function grupo(){
      return $this->belongsTo('\App\Grupo');
    }

    //un estudiante es representado por un acudiente
    public function acudiente(){
      return $this->belongsTo('\App\Acudiente');
    }
}
