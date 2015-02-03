<?php

/*a
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'UsuariosController@show'));

// USUARIOS
Route::get('usuarios', array('uses' => 'UsuariosController@show')); 
// si en el navegador se ingresa a /usuarios se ejecutara el controlador show donde se mostraran todos los usuarios

Route::get('usuarios/insert', array('uses' => 'UsuariosController@insert'));
//ruta para añadir nuevo usuario, solo muestra es el formulario
 
Route::post('usuarios/insert', array('uses' => 'UsuariosController@insert2'));
// esta ruta es a la cual apunta el formulario donde se introduce la información del usuario
// como podemos observar es para recibir peticiones POST

Route::get('usuarios/update/{id}', 'UsuariosController@update');
// vista del formulario editar

Route::post('usuarios/update/{id}', 'UsuariosController@update2');
// edita los datos enviados por el formulario
Route::get('usuarios/eliminar', 'UsuariosController@eliminar');



// TARIFA
Route::get('tarifas', array('uses' => 'TarifasController@show')); 
Route::get('tarifas/insert', array('uses' => 'TarifasController@insert'));
Route::post('tarifas/insert', array('uses' => 'TarifasController@insert2'));
Route::get('tarifas/update/{id}', 'TarifasController@update');
Route::post('tarifas/update/{id}', 'TarifasController@update2');
Route::get('tarifas/eliminar', 'TarifasController@eliminar');




// funcion para select dinamico
/*
Route::get('dropdown', function(){
		$id = Input::get('id');
		$user = Usuario::find($id);

$user->delete();



	});

*/



