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
    $latest_product = App\Product::latest()->take(5)->get();
    $offer_product = App\Product::get()->filter(function($item){return $item->offer !== null;})->take(5);
    return view('welcome', [
        'latest_product' => $latest_product,
        'offer_product' => $offer_product
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product', 'ProductController@index');
Route::post('/product', 'ProductController@search');
Route::get('/product/{product}', 'ProductController@show');
Route::get('/product/category/{category}', 'ProductController@sort');

Route::middleware('auth')->group(function() {
    Route::get('/cart', 'CartController@index');
    Route::post('/cart', 'NotificationController@store');
    Route::get('/cart/{cart}', 'CartController@show');
    Route::delete('/cart/{cart}', 'CartController@destroy');
    Route::get('/product/{product}/cart', 'CartController@store');
    Route::post('/cart/{cart}/increment', 'CartController@increment');
    Route::post('/cart/{cart}/decrement', 'CartController@decrement');
    Route::get('/notifications', 'NotificationController@index');
    Route::get('/admin', 'AdminController@index');
    Route::delete('/admin/{product}', 'AdminController@destroy');
    Route::get('/admin/category/edit/{category}', 'CategoryController@edit');
    Route::post('/admin/category/next/{category}', 'CategoryController@next');
    Route::get('/admin/attribute', 'AttributeController@index');
    Route::put('/admin/attribute/update/{category}', 'AttributeController@update');
    Route::get('/admin/edit/{admin}', 'AdminController@edit');
    Route::put('/admin/edit/next/{admin}', 'AdminController@editNext');
    Route::put('/admin/edit/{admin}', 'AdminController@update');
    Route::get('/admin/create', 'AdminController@create');
    Route::post('/admin/next', 'AdminController@next');
    Route::post('/admin/add/{product}', 'AdminController@store');
    Route::get('/admin/userDetails', 'AdminController@viewUser');
    Route::post('/admin/userDetails/{user}', 'AdminController@changeRole');
    Route::get('/admin/category/create', 'CategoryController@create');
    Route::post('/admin/category/create', 'CategoryController@store');
    Route::delete('/admin/category/{category}', 'CategoryController@destroy');
    Route::post('/admin/attribute/create/{category}', 'AttributeController@store');
    Route::delete('/admin/attribute/{attribute}', 'AttributeController@destroy');
    Route::get('/admin/attribute/create', 'AttributeController@create');
    Route::post('/admin/attribute/create', 'AttributeController@storeSeparate');
    Route::get('/getCategory/{category}', 'AdminController@getCategory');
});
