<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('InicioDocXy');
})->name('inicio');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'docente', 'namespace' => 'Docente'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('docente.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('docente.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('docente.logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('docente.showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('docente.register');
    Route::group(['prefix' => 'home'], function(){
      Route::get('/', 'HomeController@index')->name('docente.inicio');
      Route::post('/', 'HomeController@crearGrupo')->name('docente.crearGrupo');
      Route::put('/', 'HomeController@estadoSolicitud')->name('docente.estadoSolicitud');
      Route::get('/agregarAcudiente/{soli_id}', 'HomeController@agregarAcudiente')->name('docente.agregarAcudiente');
      Route::group(['prefix' => 'grupo'], function(){
        Route::get('{grupo}', 'HomeController@verGrupo')->name('docente.showGroup');
        Route::delete('/eliminarGrupo', 'HomeController@eliminarGrupo')->name('docente.eliminarGrupo');
        Route::post('/crearActividad', 'HomeController@crearActividad')->name('docente.crearActividad');
        Route::post('/crearComentario', 'HomeController@crearComentario')->name('docente.crearComentario');
        Route::post('/agregarEstudiante', 'HomeController@agregarEstudiante')->name('docente.agregarEstudiante');
        Route::post('/agregarDocente', 'HomeController@agregarDocente')->name('docente.agregarDocente');

      });
      Route::group(['prefix' => 'mensajes'], function(){
        route::get('/', 'HomeController@verChat')->name('docente.showChats');
        Route::post('/nuevoChat', 'HomeController@nuevoChat')->name('docente.home.mensajes.nuevoChat');
        Route::get('/chat/{Chat}', 'HomeController@crearChat')->name('docente.home.mensajes.chat');
        Route::post('chatear', 'HomeController@chatear')->name('docente.home.mensajes.chatear');
      });
    });
});

Route::group(['prefix' => 'acudiente', 'namespace' => 'Acudiente'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('acudiente.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('acudiente.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('acudiente.logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('acudiente.showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('acudiente.register');
    Route::get('home', 'HomeController@index')->name('acudiente.home');
    Route::get('home/comentario/{Acudiente}/{Docente}/{Actividad}', 'ComentarioController@create')->name('acudiente.home.comentario');
    Route::get('home/grupo/{Grupo}', 'GrupoController@index')->name('acudiente.home.grupo');
    Route::get('home/mensajes', 'HomeController@mensajes');
    Route::get('home/buscar', 'GrupoController@buscaGrupo')->name('acudiente.home.buscar');
    Route::get('home/solicitud/{Grupo}/{Acudiente}', 'SolicitudController@crear')->name('acudiente.home.solicitud');
    Route::get('home/estudiante/{Acudiente}/{IdEstu}', 'GrupoController@estudiante')->name('acudiente.home.estudiante');
    Route::get('home/chat/{Chat}', 'ChatController@index')->name('acudiente.home.chat');
    Route::get('home/chatear/{Acudiente}/{Chat}', 'ChatController@chatear')->name('acudiente.home.chatear');
    Route::post('home/nuevoChat', 'ChatController@nuevoChat')->name('acudiente.home.nuevoChat');
});
