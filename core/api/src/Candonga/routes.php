<?php

Route::group(['middleware' => 'web'], function() {

    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::group(['namespace' => 'Candonga\Http\Controllers'], function(){

        /* Index */
        Route::get('/', 'IndexController@index')->name('index');

        /**
         * Protected routes
         */
        Route::group(['middleware' => 'auth'], function(){

            /**
             * Customers
             */
            Route::group(['prefix' => 'customers', 'as' => 'customers.'], function(){
                Route::get('/', ['uses' => 'CustomersController@index', 'as' => 'index']);
                Route::get('/add', ['uses' => 'CustomersController@add', 'as' => 'add']);
                Route::put('/', ['uses' => 'CustomersController@store', 'as' => 'store']);
                Route::get('/{id}', ['uses' => 'CustomersController@edit', 'as' => 'edit']);
                Route::post('/{id}', ['uses' => 'CustomersController@update', 'as' => 'update']);
                Route::delete('/{id}', ['uses' => 'CustomersController@delete', 'as' => 'delete']);
            });

        });
    });


});


/*
 |
 |API Routes
 |
 */
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



