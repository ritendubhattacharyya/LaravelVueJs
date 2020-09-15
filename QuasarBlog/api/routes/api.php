<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth', 'namespace' => 'authapi', 'middleware' => 'api'], function() {
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LogoutController@logout');
    Route::get('/me', 'MeController@me');
});

//user controller
Route::post('/users/list', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::put('/users/{userId}/edit', 'UserController@edit');
Route::get('/users/check', 'UserController@role');
Route::post('/users/online', 'UserController@online');
Route::post('/users/offline', 'UserController@offline');

//admin controller
Route::post('/posts', 'AdminController@index');
Route::post('/posts/add', 'AdminController@store');
Route::delete('/posts/{postId}/delete', 'AdminController@destroy');
Route::get('/posts/{postId}/edit', 'AdminController@edit');
Route::put('/posts/{postId}/edit', 'AdminController@update');

