<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth')->group(function() {
    Route::get('/tweeks', 'TweekController@index')->name('home');
    Route::post('/tweeks', 'TweekController@store');
    Route::post('/likes/{tweek}', 'LikeController@like');
    Route::post('/dislikes/{tweek}', 'LikeController@dislike');
    Route::get('/profile/{profile}', 'ProfileController@show');
    Route::get('/profile/{profile}/edit', 'ProfileController@edit');
    Route::put('/profile/{profile}/edit', 'ProfileController@update');
    Route::post('/profile/{profile}/follow', 'ProfileController@follow');
    Route::post('/profile/{profile}/unfollow', 'ProfileController@unfollow');
    Route::get('/explore', 'ExploreController@index');

});


Auth::routes();

