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
    });

    Route::group(['prefix' => 'products'], function(){
        Route::get('/', 'ProductsController@all');
        Route::get('/{id}', 'ProductsController@get');
    });
});
