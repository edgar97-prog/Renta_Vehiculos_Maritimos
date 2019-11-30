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

Route::get('/','UsuariosController@inicio');

/* Rutas para controlador usuario */
Route::resource('/usuarios','UsuariosController');
Route::post('/nvoEmpleado','UsuariosController@storeEmpleado');
Route::get('/paneladmin','UsuariosController@paneladmin');
Route::get('/Empleados','UsuariosController@datosEmpleado');
Route::post('/datosEmp','UsuariosController@infoEmpleados');
Route::post('/comentarios','UsuariosController@muestraComentarios');
Route::post('/getMsjs','UsuariosController@obtenerMensajes');
Route::post('/datosCliente','UsuariosController@datosCliente');
//Route::get('/cuenta','UsuariosController@index');
//Controlador para vehiculos
Route::resource('/vehiculos','VehiculosController');	
Route::post('/datos/vehiculo','VehiculosController@datos');
Route::post('/rentas','VehiculosController@rentas');
#BUSQUEDA ESPECIFICA
Route::post('/busqueda/especifica','VehiculosController@busqueda');

//Rutas para login y logout
//----------------------------------------

Route::get('/logout','UsuariosController@logout');
Route::post('/login','UsuariosController@login');
//----------------------------------------

//RUTAS PARA EL CATALOGO DE PRODUCTOS

Route::get('/catalogo','VehiculosController@catalogo');

//RUTA PARA ENVIAR LOS COMENTARIOS
Route::post('/comentario','UsuariosController@comentario');

//FAVORITOS
Route::resource('/fav','FavoritosController');
Route::post('fav/eliminar','FavoritosController@eliminar');
Route::get('/pruebaDolar','VehiculosController@pruebaDolar');

Route::get('/muestraFavoritos','VehiculosController@mostrarFavoritos');

//MOSTRAR LAS RENTAS

Route::get('/muestra/rentas','VehiculosController@muestraRentas');

//Administrar rentas (Aceptar/Cancelar)

Route::get('/administra/renta/{id}/{accion}','VehiculosController@administraRenta');

Route::post('/rentas/especificas','VehiculosController@rentasEspecifica');