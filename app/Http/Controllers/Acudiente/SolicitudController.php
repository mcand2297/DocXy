<?php

namespace App\Http\Controllers\Acudiente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitud;
use App\Grupo;
class SolicitudController extends Controller
{
    public function crear($gru, $acu, Request $req){
        $grupo=$req->input('codigo');
        $bC= Grupo::where('codigo_ingreso', '=', $grupo)->get();
        //dd($bC);
        $bI= Grupo::where('id', '=', $gru)->get();
        foreach ($bC as $bII) {
            foreach ($bI as $bCC) {
                if($bCC->nombre == $bII->nombre){
                    $solicitud=new Solicitud;
                    $solicitud->acudiente_id= $acu;
                    $solicitud->grupo_id= $gru;
                    $solicitud->save(); 
                }
            }
        }  
        return Redirect()->route('acudiente.home');//view('acudiente.Eventos(Acudiente)');
        //return back()->with('bG', $bG);

    }
}
