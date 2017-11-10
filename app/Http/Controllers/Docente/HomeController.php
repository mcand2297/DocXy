<?php

namespace App\Http\Controllers\Docente;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Grupo;
use App\Docente;
use App\Actividad;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('docente.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $grupos = Auth::guard('docente')->user()->grupos;
        //dd($grupos);
        return view('docente.Eventos(Maestro)')->with('grupos', $grupos);
    }

    public function verGrupo($grupo){
      //dd($request);
      $grp = Grupo::find($grupo);
      //$actividades = Actividad::where('grupo_id', "=", $grp->id)->get();
      //dd($actividades);
      foreach ($grp->docentes as $docente){
        if($docente->pivot->responsable){
            $docenteResponsable = Docente::find($docente->id);
        }
      }
      //dd($docenteResponsable);
      //para comparar los docentes y encontrar cuales pertenencen al grupo
      $docentesGenerales = Docente::all();
      $grupos = Auth::guard('docente')->user()->grupos;
      return view('docente.Grupo(Maestro)')->with('grupo', $grp)->with('docenteResponsable',
      $docenteResponsable)->with('grupos', $grupos)->with('docentesGenerales', $docentesGenerales);
    }

    public function crearGrupo(Request $request){
      $grupo = new Grupo;
      $grupo->nombre = $request['nombre'];
      $grupo->codigo_ingreso = $request['codigo_ingreso'];
      $grupo->save();
      $grupo->docentes()->attach($request['docente_id'],['responsable' => true]);
      //dd($grupo);
      $docenteResponsable = Docente::find(Auth::guard('docente')->user()->id);
      //dd($docenteResponsable);
      $grupos = Auth::guard('docente')->user()->grupos;
      return view('docente.Eventos(Maestro)')->with('grupos', $grupos);
      //return view('docente.Grupo(Maestro)')->with('grupo', $grupo)->with('docenteResponsable', $docenteResponsable);
    }

    public function crearActividad(Request $request){
      $act = new Actividad;
      //dd($request);
      $act->comunicado = $request->comunicado;
      $act->grupo_id = $request->grupo_id;
      $act->docente_id = Auth::guard('docente')->user()->id;
      $act->save();
      return redirect("docente/home/grupo/".$request->grupo_id);
    }
}
