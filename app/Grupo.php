<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table='grupos';

    protected $fillable=[
      'codigo_ingreso', 'nombre',
    ];

    //un grupo posee varios estudiantes
    public function estudiantes(){
      return $this->hasMany('App\Estudiante');
    }

    //un grupo posee varios acudientes
    public function acudientes(){
      return $this->belongsToMany('App\Acudiente');
    }

    //un grupo posee varios docentes
    public function docentes(){
      return $this->belongsToMany('App\Docente')->withPivot('responsable');
    }

    //un grupo posee varias actividades
    public function actividades(){
      return $this->hasMany('App\Actividad');
    }

    //un grupo hace parte de una solicitud
    public function solicitud(){
      return $this->belongsTo('App\Solicitud');
    }
}
