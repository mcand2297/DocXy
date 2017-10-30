<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table='asignaturas';

    protected $fillable=['nombre', ];

    //una asignatura es impartida por varios docentes
    public function docentes(){
      return $this->belongsToMany('App\Docente');
    }
}
