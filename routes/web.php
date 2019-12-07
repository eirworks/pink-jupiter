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

    Route::resource('categories', "CategoryController");

    Route::group(['prefix' => 'provinces', 'as' => 'provinces.'], function() {
        Route::get('/', "ProvinceController@index")->name('all');
        Route::get('/new', "ProvinceController@create")->name('create');
        Route::post('/new', "ProvinceController@store")->name('store');
        Route::get('/{province}/edit', "ProvinceController@edit")->name('edit');
        Route::put('/{province}/edit', "ProvinceController@update")->name('update');
        Route::delete('/{province}/delete', "ProvinceController@delete")->name('delete');
    });

    Route::group(['prefix' => 'cities', 'as' => 'cities.'], function() {
        Route::get('/new', "CityController@create")->name('create');
        Route::post('/new', "CityController@store")->name('store');
        Route::get('/{city}/edit', "CityController@edit")->name('edit');
        Route::put('/{city}/edit', "CityController@update")->name('update');
        Route::delete('/{city}/delete', "CityController@delete")->name('delete');
    });
});
