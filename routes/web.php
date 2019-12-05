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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {

    Route::get('/', "HomeController@index")->name('home');

    Route::group(['namespace' => 'Auth' ], function() {

        Route::get('login', "LoginController@login")->name('login');
        Route::post('login', "LoginController@submitLogin")->name('login.submit');

    });

});
