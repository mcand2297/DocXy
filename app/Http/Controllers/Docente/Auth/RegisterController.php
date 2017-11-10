<?php

namespace App\Http\Controllers\Docente\Auth;

use App\Docente;
use App\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/docente/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('docente.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nick' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:docentes',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $docente = new Docente;
        $docente->nick = $data['nick'];
        $docente->nombre = $data['nombre'];
        $docente->apellido = $data['apellido'];
        $docente->email = $data['email'];
        $docente->password = bcrypt($data['password']);
        $docente -> save();
        $docente -> asignaturas() -> attach($data['category']);

        return $docente;

        /*return Docente::create([
            'nick' => $data['nick'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
    }

    public function showRegistrationForm()
    {
        $asig = Asignatura::orderBy('id', 'ASC') -> paginate(5);
        return view('docente.auth.RegistroDocente', compact('asig'));
    }

    protected function guard()
    {
        return Auth::guard('docente');
    }
}
