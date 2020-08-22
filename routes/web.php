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

Route::get('/products',"ProductController@index")->name("products");
Route::get('/checkout',"OrderController@checkout")->name("checkout");
Route::get('/orders',"OrderController@list")->name("orders");
Route::get('/order/{id}',"OrderController@view")->name("order");
Route::post('/registerOrder',"OrderController@register")->name("registerOrder");
