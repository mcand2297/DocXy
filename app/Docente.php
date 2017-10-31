<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table='docentes';

    protected $fillable = [
        'nick', 'nombre', 'apellido',
        'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //un docente puede impartir varias asignaturas
    public function asignaturas(){
        return $this->belongsToMany('App\Asignatura');
    }

    //un docente puede estar en varios grupos
    public function grupos(){
      return $this->belongsToMany('App\Grupo')->withPivot('responsable');
    }

    //un docente hace parte de un chat
    public function chat(){
      return $this->belongsTo('App\Chat');
    }
}
