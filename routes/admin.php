<?php

Route::group(['prefix' => 'orders'], function () {
    Route::get('', function () {
        $orders = [];
        return view('pages.admin.orders.index', compact('orders'));
    })->name('orders.index');
});

Route::group(['prefix' => 'settings'], function () {
    Route::get('', 'SettingController@index')->name('settings.index');
    Route::post('', 'SettingController@update')->name('settings.update');
});
