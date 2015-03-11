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
Route::get('login', function(){
    return View::make('login.login');
});

Route::post('login', array('uses' => 'UsuariosController@postLogin'));
Route::get('logout', 'UsuariosController@logOut');



Route::group(array('before' => 'auth'), function()
{


// USUARIOS
Route::get('/', array('uses' => 'UsuariosController@show'));
Route::get('usuarios', array('uses' => 'UsuariosController@show')); 
Route::get('usuarios/insert', array('uses' => 'UsuariosController@insert'));
Route::post('usuarios/insert', array('uses' => 'UsuariosController@insert2'));
Route::get('usuarios/update/{id}', 'UsuariosController@update');
Route::post('usuarios/update/{id}', 'UsuariosController@update2');
Route::get("usuarios/eliminar", "UsuariosController@eliminar");





//Route::get('/', array('uses' => 'ClienteController@show'));

// Clientes
Route::get('cliente', array('uses' => 'ClienteController@show')); 
Route::get('cliente/insert', array('uses' => 'ClienteController@insert'));
Route::post('cliente/insert', array('uses' => 'ClienteController@insert2'));
Route::get('cliente/update/{id}', 'ClienteController@update');
Route::post('cliente/update/{id}', 'ClienteController@update2');
Route::get('cliente/eliminar', 'ClienteController@eliminar');


// PRODUCTOS

Route::get('producto', array('uses' => 'ProductoController@show')); 
Route::get('producto/insert', array('uses' => 'ProductoController@insert'));
Route::post('producto/insert', array('uses' => 'ProductoController@insert2'));
Route::get('producto/update/{id}', 'ProductoController@update');
Route::post('producto/update/{id}', 'ProductoController@update2');
Route::get('producto/eliminar', 'ProductoController@eliminar');


// TRANSACCION

Route::get('transaccion', array('uses' => 'TransaccionController@show')); 
Route::get('transaccion/insert', array('uses' => 'TransaccionController@insert'));
Route::post('transaccion/insert', array('uses' => 'TransaccionController@insert2'));
Route::get('transaccion/update/{id}', 'TransaccionController@update');
Route::post('transaccion/update/{id}', 'TransaccionController@update2');
Route::get('transaccion/eliminar', 'TransaccionController@eliminar');



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


//Consumo


Route::get('consumo', array('uses' => 'ConsumoController@show')); 
Route::get('consumo/insert/{mes}/{ano}/{cliente_id}', array('uses' => 'ConsumoController@insert'));
Route::post('consumo/insert', array('uses' => 'ConsumoController@insert2'));
Route::get('consumo/update/{id}', 'ConsumoController@update');
Route::post('consumo/update/{id}', 'ConsumoController@update2');
Route::get('consumo/eliminar', 'ConsumoController@eliminar');
Route::post('consumo/editable', 'ConsumoController@editable');
Route::get('consumo/pdf/{id}', 'ConsumoController@pdf');
Route::get('consumo/pagar/{id}', 'ConsumoController@pagar');


//Consumo Tablet

Route::get('consumoTablet', array('uses' => 'ConsumotabletController@show')); 


// BOLETA
Route::get('boleta', array('uses' => 'BoletaController@show')); 
Route::get('boleta/insert', array('uses' => 'BoletaController@insert'));
Route::post('boleta/insert', array('uses' => 'BoletaController@insert2'));
Route::get('boleta/update/{id}', 'BoletaController@update');
Route::post('boleta/update/{id}', 'BoletaController@update2');
Route::get('boleta/eliminar', 'BoletaController@eliminar');
Route::get('boleta/pdf/{id}', 'BoletaController@pdf');

}); // fin before auth
