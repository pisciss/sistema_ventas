<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('auth/login');
});

//Route::get('/pacientes', 'PacienteController@index');
Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/proveedores/{id}/edit', 'ProveedorController@edit')->name('proveedores.edit');

Route::get('/productos/{id}/edit', 'ProductoController@edit')->name('productos.edit');
Route::resource('productos', 'ProductoController');

Route::resource('proveedores', 'ProveedorController');
Route::resource('clientes', 'ClienteController');
Route::resource('ingresos', 'IngresoController');
Route::resource('ventas', 'VentaController');
/*Route::get('/productos', 'ProductoController@index')->name('productos.index');
Route::get('/productos/{id}/edit', 'ProductoController@edit')->name('productos.edit');
Route::get('/productos/{id}', 'ProductoController@update')->name('productos.update');*/
//Route::resource('pacientes', 'PacienteController');
//Route::get('dataTablePaciente', 'PacienteController@dataTable')->name('dataTablePaciente');
Route::resource('categorias', 'CategoriaController');
Route::resource('users', 'UserController')->middleware('role:admin,vendedor');
Route::resource('roles', 'RoleController')->middleware('can:isAdmin');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
