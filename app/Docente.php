<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theacher extends Model
{
    protected $table='docentes';

    protected $fillable = [
        'nick', 'nombre', 'apellido',
        'email', 'password',
    ];
}
