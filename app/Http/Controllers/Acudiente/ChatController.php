<?php

namespace App\Http\Controllers\Acudiente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mensaje;
use App\Chat;
use App\Docente;
class ChatController extends Controller
{
    public function index($chat){
    	return view('acudiente.Mensajes(Acudiente)')->with('chatCompleto', $chat);
    }
    public function chatear($acudiente, $chat, Request $req){
    	$mensaje = new Mensaje;
    	$mensaje->texto = $req->input('texto');
    	$mensaje->acudiente_id = $acudiente;
    	$mensaje->chat_id = $chat;
    	$mensaje->save();
    	return view('acudiente.Mensajes(Acudiente)')->with('chatCompleto', $chat);
    }
    public function nuevoChat(Request $req){
        $chat= new Chat;
        $buscar=$req->input('docente');
        $docen= Docente::where('nick', '=', $buscar)
                            ->orWhere('email', '=', $buscar)->get();
        foreach ($docen as $doc) {
            $chat->docente_id=$doc->id;
        }
        $chat->acudiente_id=Auth::guard('acudiente')->user()->id;
        $chat->save();
        return view('acudiente.Mensajes(Acudiente)')->with('chatCompleto', $chat->id);
    }
}
