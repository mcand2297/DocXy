<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table="estudiantes";

    protected $fillable=['nombre', 'apellido', ];
}
