<?php

\Route::group(['prefix' => 'api', 'middleware' => []], function () {

    \Route::group(['middleware' => []], function () {

        \Route::group(['prefix' => 'v1', 'middleware' => []], function() {
            \Route::post('signin', 'API\V1\AuthController@signIn');

            \Route::post('signin/{social}', 'API\V1\AuthController@signInBySocial');

            \Route::post('forgot-password', 'API\V1\PasswordController@forgotPassword');

            \Route::post('signup', 'API\V1\AuthController@signUp');


            \Route::post('/ads/interstitial', 'API\V1\ApplicationController@interstitial');
            \Route::post('/offers', 'API\V1\ApplicationController@offers');
            \Route::post('/messagebox', 'API\V1\ApplicationController@messagebox');
            \Route::post('/checkmode', 'API\V1\ApplicationController@checkmode');
        });

    });

    \Route::group(['middleware' => ['api.auth']], function () {

        \Route::group(['prefix' => 'v1', 'middleware' => []], function() {
            \Route::resource('articles', 'API\V1\ArticleController');

            \Route::group(['prefix' => 'profile'], function() {
                \Route::get('/getInfo', 'API\V1\UserController@show');
                \Route::put('/update', 'API\V1\UserController@update');
            });

            \Route::post('signout', 'API\V1\AuthController@postSignOut');
        });

    });
});

