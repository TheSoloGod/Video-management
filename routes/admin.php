<?php

Route::namespace('Admin')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/home', 'HomeController@index');
    });
});
