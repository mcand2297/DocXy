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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'docente', 'namespace' => 'Docente'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('docente.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('docente.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('docente.logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('docente.showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('docente.register');
    Route::get('home', 'HomeController@index');
});

Route::group(['prefix' => 'acudiente', 'namespace' => 'Acudiente'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('acudiente.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('acudiente.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('acudiente.logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('acudiente.showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('acudiente.register');
    Route::get('home', 'HomeController@index');
});
