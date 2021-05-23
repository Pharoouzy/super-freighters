<?php

Route::resource('orders', 'OrderController');

Route::group(['prefix' => 'settings'], function (){
    Route::get('', 'SettingController@index')->name('settings.index');
    Route::post('', 'SettingController@update')->name('settings.update');
});

Route::resource('countries', 'CountryController');

Route::resource('modes', 'ModeController');
