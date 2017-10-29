<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table='asignaturas';

    protected $fillable=['nombre', ];
}
