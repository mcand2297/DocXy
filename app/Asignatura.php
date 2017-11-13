<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table='asignaturas';

    protected $fillable=['nombre', ];

    public function actividades(){
      return $this->hasMany('App\Actividad');
    }

    //una asignatura es impartida por varios docentes
    public function docentes(){
      return $this->belongsToMany('App\Docente', 'asignatura_docente_grupo')
      ->withPivot('grupo_id','responsable');
    }

    public function grupos(){
      return $this->belongsToMany('App\Grupo', 'asignatura_docente_grupo')
      ->withPivot('docente_id', 'responsable');
    }
}
