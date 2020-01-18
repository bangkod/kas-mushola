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

Route::get('/', 'HomeController@home')->name('home');
Route::get('/kas/masuk', 'KasController@kas_masuk');
Route::get('/kas/keluar', 'KasController@kas_keluar');
Route::post('/kas/store', 'KasController@store');
Route::post('/kas/delete', 'KasController@destroy');

Route::get('/master/user', 'UserController@index');
Route::get('/user/get/{id}', 'UserController@get');
Route::post('/user/change', 'UserController@change');

Auth::routes();
