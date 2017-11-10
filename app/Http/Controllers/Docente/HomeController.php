<?php

namespace App\Http\Controllers\Docente;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Grupo;
use App\Docente;

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

    public function verGrupo(Request $request){
      //dd($request);
      $grupo = Grupo::find($request->grupo_id);
      //$docenteResponsable = $grupo->pivot->responsable;
      foreach ($grupo->docentes as $docente) {
        if($docenteResponsable = $docente->pivot->responsable){
            $docenteResponsable = Docente::find($docenteResponsable);
        }
      }
      //dd($docenteResponsable);
      $docentesGenerales = Docente::all();
      $grupos = Auth::guard('docente')->user()->grupos;
      return view('docente.Grupo(Maestro)')->with('grupo', $grupo)->with('docenteResponsable',
      $docenteResponsable)->with('grupos', $grupos)->with('docentesGenerales', $docentesGenerales);
    }

    public function crearGrupo(Request $request){
      $grupo = new Grupo;
      $grupo->nombre = $request['nombre'];
      $grupo->codigo_ingreso = $request['codigo_ingreso'];
      $grupo->save();
      $grupo->docentes()->attach($request['docente_id'],['responsable' => $request['docente_id']]);
      //dd($grupo);
      $docenteResponsable = Docente::find(Auth::guard('docente')->user()->id);
      //dd($docenteResponsable);
      $grupos = Auth::guard('docente')->user()->grupos;
      return view('docente.Eventos(Maestro)')->with('grupos', $grupos);
      //return view('docente.Grupo(Maestro)')->with('grupo', $grupo)->with('docenteResponsable', $docenteResponsable);
    }
}
