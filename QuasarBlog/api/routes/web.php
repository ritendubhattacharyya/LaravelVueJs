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

Route::get('/', 'PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth:web')->group(function() {
    Route::get('/posts/{postId}', 'PostController@show')->name('showBlog');
    Route::post('/comments/{postId}', 'CommentController@store');
    Route::delete('/comments/{commentId}/delete', 'CommentController@destroy');
});

