<?php

Route::group(['namespace' => 'Candonga\Http\Controllers\Api', 'prefix' => 'api'], function(){
    /**
     * Auth routes
     */
    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', 'AuthController@login') ;
        Route::get('logout', 'AuthController@logout') ;
    });


    Route::group(['prefix' => 'customers'], function(){
        Route::get('/', 'CustomersController@all');
        Route::get('/{id}', 'CustomersController@get');
        Route::get('/{id}/products', 'CustomersController@products');
        Route::put('/', 'CustomersController@put');
        Route::post('/{id}', 'CustomersController@post');
        Route::delete('/{id}', 'CustomersController@delete');
    });

    Route::group(['prefix' => 'products'], function(){
        Route::get('/', 'ProductsController@all');
        Route::get('/{id}', 'ProductsController@get');
        Route::put('/', 'ProductsController@put');
        Route::post('/{id}', 'ProductsController@post');
        Route::delete('/{id}', 'ProductsController@delete');
    });
});
