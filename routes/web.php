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

Route::group(['namespace' => 'Partner', 'prefix' => 'partner', 'as' => 'partner.'], function() {
    Route::get('register', "RegisterController@register")->name('register');
    Route::post('register', "RegisterController@store")->name('register.submit');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {

    Route::get('/edit', "ProfileController@edit")->name('edit');
    Route::put('/edit', "ProfileController@update")->name('update');
    Route::put('/edit/service', "ProfileController@updateServices")->name('update.services');

});

Route::group(['prefix' => 'listing', 'as' => 'listing.'], function() {
    Route::get('/', "ListingController@index")->name('index');
    Route::get('/{user}', "ListingController@show")->name('show');
    Route::get('/{user}/wa', "ListingController@contactWhatsapp")->name('contact.wa');
});

Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function() {
    Route::get('/', "DepositController@create")->name('create');
    Route::post('/', "DepositController@store")->name('store');
});

Route::get('/transactions', "BalanceController@index")->name('transactions.index');


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

    Route::group(['prefix' => 'partners', 'as' => 'partners.'], function() {
        Route::get('/', "PartnerController@index")->name('index');
        Route::get('/new', "PartnerController@create")->name('create');
        Route::post('/new', "PartnerController@store")->name('store');
        Route::get('/{user}/edit', "PartnerController@edit")->name('edit');
        Route::post('/{user}/edit', "PartnerController@update")->name('update');
        Route::put('/{user}/activate', "PartnerController@activate")->name('activate');
        Route::delete('/{user}/delete', "PartnerController@destroy")->name('delete');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/', "AdminController@index")->name('index');
        Route::get('/new', "AdminController@create")->name('create');
        Route::post('/new', "AdminController@store")->name('store');
        Route::get('/{user}/edit', "AdminController@edit")->name('edit');
        Route::post('/{user}/edit', "AdminController@update")->name('update');
        Route::delete('/{user}/delete', "AdminController@destroy")->name('delete');
    });


    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
        Route::get('/', "SettingsController@index")->name('edit');
        Route::post('/', "SettingsController@update")->name('update');
    });

    Route::group(['prefix' => 'deposits', 'as' => 'deposits.'], function() {
        Route::get('/', "DepositRequestController@index")->name('index');
        Route::get('/{request}', "DepositRequestController@show")->name('show');
        Route::put('/{request}', "DepositRequestController@update")->name('update');
        Route::delete('/{request}', "DepositRequestController@destroy")->name('delete');
    });

    Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function() {
        Route::get('/', "UserTransactionController@index")->name('index');
        Route::post('/', "UserTransactionController@show")->name('show');
    });
});
