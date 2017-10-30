<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table='grupos';

    protected $fillable=[
      'codigo_ingreso', 'nombre',
    ];

    public function estudiantes(){
      return $this->hasMany('App\Estudiante');
    }
}
