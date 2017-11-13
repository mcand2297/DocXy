<?php

namespace App\Http\Controllers\Docente;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;//para heredar
use Illuminate\Http\Request;//para tratar peticiones
use App\Grupo;
use App\Docente;
use App\Actividad;
use App\Comentario;
use App\Estudiante;
use App\Asignatura;

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
    {   $grupos = Auth::guard('docente')->user()->grupos->unique('id');//elimina duplicados
        $asigs = Asignatura::orderBy('id', 'ASC') -> paginate(5);
        return view('docente.Eventos(Maestro)')->with('grupos', $grupos)->with('asigs', $asigs);
    }

    public function verChat(){
      $grupos = Auth::guard('docente')->user()->grupos->unique('id');
      $asigs = Asignatura::orderBy('id', 'ASC') -> paginate(5);
      return view('docente.Mensajes(Maestro)')->with('grupos', $grupos)->with('asigs', $asigs);
    }

    public function verGrupo($grupo){
      $asigs = Asignatura::orderBy('id', 'ASC') -> paginate(5);//obtener asignaturas disponibles
      $grp = Grupo::find($grupo);//obtener grupo a ver
      //para ver quien es el docente responsable del grupo
      foreach ($grp->docentes->unique('id') as $docente){
        if($docente->pivot->responsable){
            $docenteResponsable = Docente::find($docente->id);
        }
      }
      //para comparar los docentes y encontrar cuales pertenencen al grupo
      $docentesGenerales = Docente::all();
      $grupos = Auth::guard('docente')->user()->grupos;
      $grupos = $grupos->unique('id');//elimina duplicados
      //para ver cuales asignaturas imparte un docente en el grupo
      $asigsActv = collect();
      foreach (Auth::guard('docente')->user()->grupos as $grupo) {
        if($grupo->id == $grp->id){
          $asigsActv = $grupo->asignaturas;
        }
      }
      //para mostrar la vista del grupo
      return view('docente.Grupo(Maestro)')->with('grupo', $grp)->with('docenteResponsable',
      $docenteResponsable)->with('grupos', $grupos)->with('docentesGenerales', $docentesGenerales)->with('asigs', $asigs)
      ->with('asigsActv', $asigsActv);
    }

    public function crearGrupo(Request $request){
      //creacion del grupo
      $grupo = new Grupo;
      $grupo->nombre = $request['nombre'];
      $grupo->codigo_ingreso = $request['codigo_ingreso'];
      $grupo->save();
      //con ayuda de la tabla pivot se relaciona el docente con las asignaturas que va a impartir en el grupo
      foreach ($request->category as $categ) {
        $grupo->docentes()->attach($request['docente_id'],['asignatura_id' => $categ ,'responsable' => true]);
      }
      //se pasa la variable con el id del responsable del grupo
      $docenteResponsable = Docente::find(Auth::guard('docente')->user()->id);
      $grupos = Auth::guard('docente')->user()->grupos;
      return redirect()->back();
    }

    public function eliminarGrupo(Request $request){
      $grp = Grupo::find($request->grupo);
      $grp->delete();
      return redirect("/docente/home");
    }

    public function crearActividad(Request $request){
      $act = new Actividad;
      //dd($request);
      $act->comunicado = $request->comunicado;
      $act->grupo_id = $request->grupo_id;
      $act->docente_id = Auth::guard('docente')->user()->id;
      $act->asignatura_id = $request->category;
      $act->save();
      return redirect()->back();
    }

    public function agregarDocente(Request $request){
      $grp = Grupo::find($request->grupo);
      $doc = Docente::where('nick',"=", $request->nick)->first();
      if(!is_null($doc)){
        //verificar si el docente ya esta agregado
        foreach ($grp->docentes->unique('id') as $docente) {
          if($docente->id == $doc->id){
            return redirect()->back();
          }
        }
        foreach ($request->category as $categ) {
          $grp->docentes()->attach($doc->id,['asignatura_id' => $categ, ]);
        }
      }
      return redirect()->back();
    }

    public function agregarEstudiante(Request $request){
      $est = new Estudiante;
      $est->nombre = $request->nombre;
      $est->apellido = $request->apellido;
      $est->grupo_id = $request->grupo;
      $est->save();
      return redirect()->back();
    }

    public function crearComentario(Request $request){
      $coment = new Comentario;
      $act = Actividad::find($request->actividad);
      $coment->texto = $request->texto;
      $coment->docente_id = Auth::guard('docente')->user()->id;
      $coment->actividad_id = $act->id;
      $coment->save();
      return redirect()->back();
    }
}
