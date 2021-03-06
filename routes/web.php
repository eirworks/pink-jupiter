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

use App\Http\Middleware\AuthIsAdmin;
use App\Http\Middleware\ClickSession;


Route::get('/', 'HomeController@index')->name('home')->middleware([ClickSession::class]);
Route::get('/elektronik', 'HomeController@shops')->name('shops')->middleware([ClickSession::class]);
Route::get('/tools', 'HomeController@tools')->name('tools')->middleware([ClickSession::class]);

Route::post('logout', "LogoutController@logout")->name('logout');

Route::group(['namespace' => 'Partner', 'prefix' => 'partner', 'as' => 'partner.'], function() {

    // TODO wrap login and register with some guest only middleware

    Route::get('login', "LoginController@index")->name('login');
    Route::post('login', "LoginController@store")->name('login.store');

    Route::get('register', "RegisterController@register")->name('register');
    Route::post('register', "RegisterController@store")->name('register.submit');

    Route::group(['middleware' => 'auth'], function() {

        // Partner's Service CRUD
        Route::group(['prefix' => 'services', 'as' => 'services.'], function() {
            Route::get('/', 'ServiceController@index')->name('index');
            Route::get('/new', 'ServiceController@create')->name('new');
            Route::post('/new', 'ServiceController@store')->name('store');
            Route::get('/edit/{service}', 'ServiceController@edit')->name('edit');
            Route::post('/edit/{service}', 'ServiceController@update')->name('update');
            Route::delete('/delete/{service}', 'ServiceController@destroy')->name('destroy');
        });


    });
});

Route::group(['middleware' => 'auth'], function() {
    // Edit profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {

        Route::get('/edit', "ProfileController@edit")->name('edit');
        Route::put('/edit', "ProfileController@update")->name('update');
        Route::put('/edit/service', "ProfileController@updateServices")->name('update.services');

    });
});

Route::group(['prefix' => 'articles', 'as' => 'articles.'], function() {
    Route::get('/', 'ArticleController@index')->name('index');
    Route::get('/{slug}/{post}', 'ArticleController@show')->name('show');
});

Route::group(['prefix' => 'listing', 'as' => 'listing.', 'middleware' => ClickSession::class], function() {
    Route::get('/', "ListingController@index")->name('index'); // not used
    Route::get('/{service}', "ListingController@show")->name('show');
    Route::get('/{service}/contact/{type}', "ListingController@contact")->name('contact');
});

Route::get('categories', "CategoryListingController@index")->name('listing.categories.index');
Route::get('category/{category}/{slug}', "CategoryListingController@show")->name('listing.categories.show');

Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function() {
    Route::get('/', "DepositController@create")->name('create');
    Route::post('/', "DepositController@store")->name('store');
});

Route::get('/transactions', "BalanceController@index")->name('transactions.index');

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'as' => 'api.'], function() {

    Route::get('cities', 'CityController@cities')->name('cities');
    Route::get('provinces', 'CityController@provinces')->name('provinces');

    Route::get('categories', 'CategoryController@index')->name('categories');
    Route::get('subcategories', 'CategoryController@subcategories')->name('subcategories');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {

    Route::get('/', "HomeController@index")->name('home');

    Route::group(['namespace' => 'Auth' ], function() {

        Route::get('login', "LoginController@login")->name('login');
        Route::post('login', "LoginController@submitLogin")->name('login.submit');
    });

    Route::group(['middleware' => AuthIsAdmin::class], function() {

        Route::get('categories/upload', "CategoryUploadController@index")->name('categories.upload');
        Route::get('categories/download', "CategoryUploadController@download")->name('categories.download');
        Route::post('categories/upload', "CategoryUploadController@store")->name('categories.upload.store');

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
            Route::put('/{user}/edit', "AdminController@update")->name('update');
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
            Route::post('/', "UserTransactionController@store")->name('store');
            Route::get('/{user}', "UserTransactionController@create")->name('create');
        });

        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function() {
            Route::get('/', "PostController@index")->name('index');
            Route::get('/new', "PostController@create")->name('create');
            Route::post('/new', "PostController@store")->name('store');
            Route::get('/{post}', "PostController@edit")->name('edit');
            Route::put('/{post}', "PostController@update")->name('update');
            Route::put('/{post}/toggle-publish', "PostController@togglePublish")->name('publish');
            Route::delete('/{post}', "PostController@destroy")->name('delete');
        });

        Route::group(['prefix' => 'services', 'as' => 'services.'], function() {
            Route::get('/', 'ServiceController@index')->name('index');
            Route::get('/edit/{service}', 'ServiceController@edit')->name('edit');
            Route::post('/edit/{service}', 'ServiceController@update')->name('update');
            Route::delete('/delete/{service}', 'ServiceController@destroy')->name('destroy');
        });
    });
});

Route::get('/p/{slug}', "ArticleController@showPage")->name('page');
