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
    return view('pages.app.home');
})->name('home');

Route::get('/summary', function () {
    return view('pages.app.summary');
})->name('summary');

Route::get('/payment/verify', function () {
    return view('pages.app.payment-status');
})->name('payment.verify');

require 'admin.php';
