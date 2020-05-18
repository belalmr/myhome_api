<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::get('categories', 'HomeScreenController@categories');
    Route::get('products', 'HomeScreenController@products');
    Route::get('bestOffers', 'HomeScreenController@bestOffers');
    Route::get('mostSelling', 'HomeScreenController@mostSelling');
    Route::get('homeSlider', 'HomeScreenController@homeSlider');

    Route::get('product/{id}', 'ProductController@show_product');
});
