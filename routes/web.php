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

Route::get('/', 'PageController@index')->name('home');

Route::get('/summary', 'OrderController@summary')->name('summary.index');
Route::post('/summary', 'OrderController@postSummary')->name('summary.post');
Route::post('/order/process', 'OrderController@process')->name('order.process');

Route::get('/payment/status', 'PaymentController@status')->name('payment.status');

Route::get('/payment/verify', 'PaymentController@verify')->name('payment.verify');

require 'admin.php';
