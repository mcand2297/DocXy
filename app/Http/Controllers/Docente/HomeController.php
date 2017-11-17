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
use App\Solicitud;
use App\Acudiente;
use App\Mensaje;
use App\Chat;

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
    {
      $grupos = Auth::guard('docente')->user()->grupos->unique('id');//elimina duplicados
      $solicitudes = collect();
      foreach ($grupos as $grupo) {
        foreach ($grupo->solicitudes as $solicitud) {
          if(is_null($solicitud->aceptado)){
            $solicitudes->push($solicitud);
          }
        }
      }
        //dd($solicitudes);
      $asigs = Asignatura::orderBy('id', 'ASC') -> paginate(5);
      return view('docente.Eventos(Maestro)')->with('grupos', $grupos)
      ->with('asigs', $asigs)->with('sols', $solicitudes);
    }

    public function verChat(){
      //parte que muestra los chats
      $chats=Auth::guard('docente')->user()->chats->reverse();
      //parte lateral que muestra los Grupo
      $grupos = Auth::guard('docente')->user()->grupos->unique('id');
      //parte de asignaturas al mostrar la ventana de crear grupo
      $asigs = Asignatura::orderBy('id', 'ASC') -> paginate(5);
      //parte de solicitudes al mostrar la ventana de notifiaciones
      $solicitudes = collect();
      foreach ($grupos as $grupo) {
        foreach ($grupo->solicitudes as $solicitud) {
          if(is_null($solicitud->aceptado)){
              $solicitudes->push($solicitud);
          }
        }
      }
      return view('docente.Mensajes(Maestro)')->with('grupos', $grupos)
      ->with('asigs', $asigs)->with('sols', $solicitudes)->with('chats', $chats);
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
      //recorrer las asignaturas de casa grupo del docente
      foreach (Auth::guard('docente')->user()->grupos->unique('id') as $gpo) {
        if($gpo->id == $grp->id){
          foreach ($gpo->asignaturas as $asig) {
            if($asig->pivot->docente_id == Auth::guard('docente')->user()->id){
              $asigsActv->push($asig);//agrega al final la asignatura en que el id docente en la tabla pivot coincide con el docente
            }
          }
        }
      }
      //dd($asigsActv);
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

    public function estadoSolicitud(Request $request){
      $soli = Solicitud::find($request->solicitud_id);
      if($request->aceptado == "true"){
        $soli->aceptado = true;
      }else{
        $soli->aceptado = false;
      }
      //dd($soli);
      $soli->save();
      //redirige a la ruta que llama al controlador que agrega al acudiente al grupo
      return redirect()->route('docente.agregarAcudiente',['soli_id'=> $soli->id]);
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

    public function agregarAcudiente($soli_id){
      //dd($soli_id);
      $grupo = Solicitud::find($soli_id)->grupo;
      $acudiente = Solicitud::find($soli_id)->acudiente;
      if(!$grupo->acudientes->contains($acudiente)){
        $grupo->acudientes()->attach($acudiente->id);
      }
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

    public function nuevoChat(Request $req){
      $chat= new Chat;
        $acu= Acudiente::where('nick', "=", $req->acudiente)
                            ->orWhere('email', '=', $req->acudiente)->first();
        //dd($acu);
        $chat->acudiente_id = $acu->id;
        $chat->docente_id = Auth::guard('docente')->user()->id;
        $chat->save();
        return redirect()->back();
        //return view('docente.Mensajes(Maestro)')->with('chatCompleto', $chat->id);
    }

    public function crearChat($chat_id){
      //parte que muestra los chats
      $chats=Auth::guard('docente')->user()->chats->reverse();
      //parte lateral que muestra los Grupo
      $grupos = Auth::guard('docente')->user()->grupos->unique('id');
      //parte de asignaturas al mostrar la ventana de crear grupo
      $asigs = Asignatura::orderBy('id', 'ASC') -> paginate(5);
      //parte de solicitudes al mostrar la ventana de notifiaciones
      $solicitudes = collect();
      foreach ($grupos as $grupo) {
        foreach ($grupo->solicitudes as $solicitud) {
          if(is_null($solicitud->aceptado)){
              $solicitudes->push($solicitud);
          }
        }
      }
      return view('docente.Mensajes(Maestro)')->with('grupos', $grupos)
      ->with('asigs', $asigs)->with('sols', $solicitudes)
      ->with('chats', $chats)->with('chatCompleto', $chat_id);
      //return view('docente.Mensajes(Maestro)')->with('chatCompleto', $chat);
    }

    public function chatear (Request $req){
      //parte que muestra los chats
      $chats=Auth::guard('docente')->user()->chats->reverse();
      //parte lateral que muestra los Grupo
      $grupos = Auth::guard('docente')->user()->grupos->unique('id');
      //parte de asignaturas al mostrar la ventana de crear grupo
      $asigs = Asignatura::orderBy('id', 'ASC') -> paginate(5);
      //parte de solicitudes al mostrar la ventana de notifiaciones
      $solicitudes = collect();
      foreach ($grupos as $grupo) {
        foreach ($grupo->solicitudes as $solicitud) {
          if(is_null($solicitud->aceptado)){
              $solicitudes->push($solicitud);
          }
        }
      }
      $mensaje = new Mensaje;
      $mensaje->texto = $req->input('texto');
      $mensaje->docente_id = $req->input('docente');
      $mensaje->chat_id = $req->input('chat');
      $mensaje->save();
      return view('docente.Mensajes(Maestro)')->with('grupos', $grupos)
      ->with('asigs', $asigs)->with('sols', $solicitudes)
      ->with('chats', $chats)->with('chatCompleto', $mensaje->chat_id);
    }
}
