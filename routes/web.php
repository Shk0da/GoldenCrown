<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::any('/', 'MainController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::resource('/', 'PanelController@index', ['names' => [
            'index' => 'panel'
        ]]);
        Route::resource('employee', 'EmployeeController', ['names' => [
            'index' => 'employee',
        ]]);
        Route::resource('workingTime', 'WorkingTimeController', ['names' => [
            'index' => 'employee.times'
        ]]);
        Route::resource('serviceTypes', 'ServiceTypeController', ['names' => [
            'index' => 'service.types'
        ]]);
        Route::resource('services', 'ServiceController', ['names' => [
            'index' => 'services'
        ]]);
        Route::resource('orders', 'OrderController', ['names' => [
            'index' => 'orders'
        ]]);
    });
});




