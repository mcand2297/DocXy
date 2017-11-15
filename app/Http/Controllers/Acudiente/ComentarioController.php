<?php

namespace App\Http\Controllers\Acudiente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comentario;

class ComentarioController extends Controller
{
    public function create($acu, $Doc, $act, Request $req){
    	$comen= new Comentario;
    	$comen-> acudiente_id = $acu;
    	$comen-> actividad_id = $act;
    	$comen-> texto =$req -> input('caja');
    	$comen->save();
        return back()->withInput();
    }
}
