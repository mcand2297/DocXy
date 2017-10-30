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

    public function asignaturas(){
        return $this->belongsToMany('App\Asignatura');
    }
}
