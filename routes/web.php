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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/','Auth\LoginController@showLoginForm');

// PREPAIDBALANCE
Route::get('/prepaid-balance','PrepaidbalanceController@index');
Route::post('/prepaid-balance','PrepaidbalanceController@buy');
Route::get('/prepaid-balance/{id}','PrepaidbalanceController@show');

// PRODUCT
Route::get('/product','ProductController@index');
Route::post('/product','ProductController@buy');
Route::get('/product/{id}','ProductController@show');

// PAYMENT
Route::get('/payment/{order_number}','PaymentController@index');
Route::get('/payment','PaymentController@index');
Route::post('/payment','PaymentController@store');

// ORDER
Route::get('/order','OrderController@index');

Route::get('/home', 'HomeController@index')->name('home');
