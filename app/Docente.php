<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Docente extends Authenticatable
{
    use Notifiable;

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
        return $this->belongsToMany('App\Asignatura', 'asignatura_docente_grupo')
        ->withPivot('grupo_id', 'responsable');
    }

    //un docente puede estar en varios grupos
    public function grupos(){
      return $this->belongsToMany('App\Grupo', 'asignatura_docente_grupo')
      ->withPivot('asignatura_id','responsable');
    }

    public function comentarios(){
      return $this->hasMany('App\Comentario');
    }

    //un docente hace parte de un chat
    public function chats(){
      return $this->hasMany('App\Chat');
    }
}
