<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table='asignaturas';

    protected $fillable=['nombre', ];

    public function docentes(){
      return $this->belongsToMany('App\Docente');
    }
}
