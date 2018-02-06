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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show'); //formulario Edicion
Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');//Ruta delete del carro
Route::post('/order', 'CartController@update');//Ruta delete del carro

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/products','ProductController@index');
    Route::get('/products/create','ProductController@create'); //registrar productos
    Route::post('/products','ProductController@store');
    Route::get('/products/{id}/edit','ProductController@edit'); //Editar productos
    Route::post('/products/{id}/edit','ProductController@update');
    Route::post('/products/{id}/delete','ProductController@destroy');
    Route::get('/products/{id}/images','ImageController@index'); //listado
    Route::post('/products/{id}/images','ImageController@store'); //registrar
    Route::delete('/products/{id}/images','ImageController@destroy'); //form eliminar
    Route::get('/products/{id}/images/select/{image}','ImageController@select'); //Destacar una imagen
});




