<?php

use Illuminate\Http\Request;
use App\Events\PusherEvent;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('event',function(){
	event(new PusherEvent());
	return ['mensagem'=>'Teste'];
});

Route::prefix('perfil')->group(function(){
	Route::group(['middleware'=> 'jwt.auth' ],function(){
		Route::middleware(['can:api-proprio-perfil,id'])->get('/{id}','Api\User\PerfilController@find');		
  	}); 
});

Route::prefix('auth')->group(function(){
	 Route::post('login','Api\Login\AuthenticateController@authenticate');
	 Route::post('refresh','Api\Login\AuthenticateController@refresh');
	 Route::post('register','Api\Login\UserController@register');
	
	 Route::group(['middleware'=> 'jwt.auth' ],function(){
		   Route::get('me','Api\Login\AuthenticateController@me');		
	 });
});



Route::middleware(['jwt.auth','perfil'])->get('teste','Api\UserController@index');
