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

Route::group(['middleware' => 'auth'],function(){
	
	Route::get('/perfil/{slug}',[

		'uses' => 'PerfilController@index',
		'as'	=> 'perfil'

		]);

	Route::get('/perfil/edit/perfil/',[

		'uses' => 'PerfilController@editar',
		'as'	=> 'perfil.edit'

		]);
	Route::post('/perfil/update/perfil/',[

		'uses' => 'PerfilController@update',
		'as'	=> 'perfil.update'

		]);

	Route::get('/check_status_amistades/{id}', [

		'uses' => 'AmistadController@check',
		'as'   => 'check'

		]);
	Route::get('/agregar_amigo/{id}', [

		'uses' => 'AmistadController@agregar_amigo',
		'as'   => 'agregar_amigo'

		]);
	Route::get('/aceptar_amigo/{id}', [

		'uses' => 'AmistadController@aceptar_amigo',
		'as'   => 'aceptar_amigo'

		]);

});