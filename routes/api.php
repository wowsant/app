<?php

use Illuminate\Http\Request;

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

Route::post('auth/login', 'APILoginController@login');
Route::post('auth/register', 'UserController@store');

Route::group(['middleware' => 'jwt.auth'], function() {

    # Retorna dados do usuario autenticado
    Route::get('user/me', 'UserController@show');
    Route::put('user/update', 'UserController@update');

});
