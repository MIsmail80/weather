<?php

Auth::routes();

Route::get('weather', 'HomeController@getWeather');

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('users', 'UserController');

        Route::resource('roles', 'RoleController');

        Route::resource('permissions', 'PermissionController');
    });
});
