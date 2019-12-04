<?php

Route::group(['namespace' => 'Candonga\Controllers', 'prefix' => 'api'], function(){
    /**
     * Auth routes
     */
    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', 'AuthController@login') ;
        Route::get('logout', 'AuthController@logout') ;
    });
});
