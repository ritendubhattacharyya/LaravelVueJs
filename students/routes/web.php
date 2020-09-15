<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/addStudent', 'StudentController@create');
Route::post('/add', 'StudentController@store');
Route::get('/home', 'StudentController@index');
Route::put('/edit/{student}', 'StudentController@update');
Route::delete('/delete/{student}', 'StudentController@destroy');

Route::get('/dynamicDependency', 'CityController@index');
Route::get('/getCity/{state}', 'CityController@show');
