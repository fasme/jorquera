<?php

/*
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



// funcion para select dinamico
/*
Route::get('dropdown', function(){
		$id = Input::get('id');
		$user = Usuario::find($id);

$user->delete();



	});

*/
Route::get('usuarios/eliminar', 'UsuariosController@eliminar');




//Route::get('/', array('uses' => 'ClienteController@show'));

// Clientes
Route::get('cliente', array('uses' => 'ClienteController@show')); 
Route::get('cliente/insert', array('uses' => 'ClienteController@insert'));
Route::post('cliente/insert', array('uses' => 'ClienteController@insert2'));
Route::get('cliente/update/{id}', 'ClienteController@update');
Route::post('cliente/update/{id}', 'ClienteController@update2');
Route::get('cliente/eliminar', 'ClienteController@eliminar');



// Tarifas
Route::get('tarifa', array('uses' => 'TarifaController@show')); 
Route::get('tarifa/insert', array('uses' => 'TarifaController@insert'));
Route::post('tarifa/insert', array('uses' => 'TarifaController@insert2'));
Route::get('tarifa/update/{id}', 'TarifaController@update');
Route::post('tarifa/update/{id}', 'TarifaController@update2');
Route::get('tarifa/eliminar', 'TarifaController@eliminar');


// TarifaDetalle
Route::get('tarifadetalle', array('uses' => 'TarifadetalleController@show')); 
Route::get('tarifadetalle/insert', array('uses' => 'TarifadetalleController@insert'));
Route::post('tarifadetalle/insert', array('uses' => 'TarifadetalleController@insert2'));
Route::get('tarifadetalle/update/{id}', 'TarifadetalleController@update');
Route::post('tarifadetalle/update/{id}', 'TarifadetalleController@update2');
Route::get('tarifadetalle/eliminar', 'TarifadetalleController@eliminar');


