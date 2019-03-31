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
Route::get('/admin/settings','SettingsController@index');
Route::post('/admin/settings/salvar','SettingsController@salvar')->name('perfil.salvar');
Route::get('/admin/usuarios','AdminUsuariosController@index')->middleware('can:somente-admin');
Route::post('/admin/alterarpermissao','AdminUsuariosController@alterarpermissao')->name('alterarpermissao')->middleware('can:somente-admin');