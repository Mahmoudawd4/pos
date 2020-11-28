<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::group(
// ['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){

    Route::name('dashboard.')->namespace('Dashboard')->middleware(['auth'])->group(function () {
    Route::get('/check','DashboardController@index')->name('index');

    //user Routs
    Route::resource('users', 'UserController')->except(['show']);

    //category routes
    Route::resource('categories', 'CategoryController')->except(['show']);

    //product routes
    Route::resource('products', 'ProductController')->except(['show']);

    //client routes
    Route::resource('clients', 'ClientController')->except(['show']);
    Route::resource('clients.orders', 'Client\OrderController')->except(['show']);





});

// });




?>



