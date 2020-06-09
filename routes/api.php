<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Api'], function () {
    Route::get('categories', 'HomeScreenController@categories');
    Route::get('products', 'HomeScreenController@products');
    Route::get('sub_category', 'ProductController@subCategory');
    Route::get('sub_category/{category_id}', 'ProductController@productsCategory');

    Route::get('bestOffers', 'HomeScreenController@bestOffers');
    Route::get('mostSelling', 'HomeScreenController@mostSelling');
    Route::get('homeSlider', 'HomeScreenController@homeSlider');
    Route::get('recentlyArrived', 'HomeScreenController@recentlyArrived');

    Route::get('product/{id}', 'ProductController@show_product');

    Route::get('page/{id}', 'AddressController@page');
    Route::get('pages', 'AddressController@pages');

    Route::get('ser', 'CartController@ser');
});

Route::group([
    'prefix' => 'auth',
    'namespace' => 'Api',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('forget_password', 'AuthController@forget_password');
    Route::post('reset_password', 'AuthController@reset_password');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('me', 'AuthController@show');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('update', 'AuthController@update');
        Route::post('change_password', 'AuthController@change_password');
        Route::post('logout', 'AuthController@logout');

        Route::post('shipping_address', 'AddressController@shipping_address');
        Route::post('payment_address', 'AddressController@payment_address');

        Route::post('orders', 'ProductController@orders');

        Route::get('countries', 'AddressController@countries');

        Route::post('favourite', 'ProductController@favourite');
        Route::post('favourites', 'ProductController@allFavourites');

        Route::post('add_cart', 'CartController@add_to_cart');
        Route::post('fetch_cart', 'CartController@fetch_cart');
        Route::post('increase_cart', 'CartController@increase_cart');
        Route::post('delete_cart', 'CartController@delete_cart');

    });
});
