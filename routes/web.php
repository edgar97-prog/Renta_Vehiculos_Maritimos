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
use app\rol;

/*
Route::get('/', function () {
    return view('welcome');
<<<<<<< HEAD
});
Route::get('cuas','RolesController@todo');

=======
});*/
Route::get('/', function () {
	return view('welcome');
});

Route::get('roles','RolesController@todo');

Route::resource('/usuarios','UsuariosController');

//Controlador para vehiculos
Route::resource('/vehiculos','VehiculosController');
Route::post('/datos/vehiculo/','VehiculosController@datos');

//Rutas para login y logout
//----------------------------------------

Route::get('/logout','UsuariosController@logout');

Route::post('/login','UsuariosController@login');
//----------------------------------------
