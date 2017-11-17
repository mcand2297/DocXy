<?php

namespace App\Http\Controllers\Acudiente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\Docente;
use App\Estudiante;
use App\Mensaje;
class GrupoController extends Controller
{
    public function index($grupo, Request $req){
    	$group= Grupo::find($grupo);
        //$buscaGrupo= $req->input('texto');
        //$bG= Grupo::where('nombre', '=', $buscaGrupo)->get();
    	foreach ($group->docentes as $docente){
    		if ($docente->pivot->responsable) {
    			$docenteResponsable=$docente;
    		}
    	}
    	//$docenteResponsable=Docente::find($docenteResponsable);
    	return view('acudiente.Grupo(Acudiente)')-> with('grupo',$group)->with('docenteResponsable', $docenteResponsable);
    }

    public function buscaGrupo(Request $req){
        $buscaGrupo= $req->input('texto');
        $bG= Grupo::where('nombre', '=', $buscaGrupo)->get();
        //dd($bG);
        return view('acudiente.Eventos(Acudiente)')->with('bG', $bG);
        //return back()->with('bG', $bG);

    }

    public function estudiante($acudiente, $estudiante){
        $estu=Estudiante::find($estudiante);
        $estu->acudiente_id = $acudiente;
        $estu->save();
        return back();
    }

    public static function buscarDocente($id){
        $docente=Docente::find($id);
        return $docente;
    }

    public static function buscarMensaje($id){
        $mensaje=Mensaje::where('chat_id', '=', $id)->get();
        return $mensaje;
    }

}
