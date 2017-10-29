<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table='comentarios';

  protected $fillable = [
    'texto', 'id_docente', 'id_acudiente',
    'id_actividad', 'created_at',
  ];
}
