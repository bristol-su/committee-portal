<?php

use Illuminate\Support\Facades\Route;

/**
 * Register the routes needed for authorization.
 *
 * @return void
 */
    Route::group(['middleware' => ['web', 'auth']], function ($router) {
        Route::get('/authorize', [
            'uses' => 'AuthorizationController@authorize',
            'as' => 'passport.authorizations.authorize',
        ]);

        Route::post('/authorize', [
            'uses' => 'ApproveAuthorizationController@approve',
            'as' => 'passport.authorizations.approve',
        ]);

        Route::delete('/authorize', [
            'uses' => 'DenyAuthorizationController@deny',
            'as' => 'passport.authorizations.deny',
        ]);
    });

/**
 * Register the routes for retrieving and issuing access tokens.
 *
 * @return void
 */
    Route::post('/token', [
        'uses' => 'AccessTokenController@issueToken',
        'as' => 'passport.token',
        'middleware' => 'throttle',
    ]);

    Route::group(['middleware' => ['web', 'auth']], function ($router) {
        Route::get('/tokens', [
            'uses' => 'AuthorizedAccessTokenController@forUser',
            'as' => 'passport.tokens.index',
        ]);

        Route::delete('/tokens/{token_id}', [
            'uses' => 'AuthorizedAccessTokenController@destroy',
            'as' => 'passport.tokens.destroy',
        ]);
    });

/**
 * Register the routes needed for refreshing transient tokens.
 *
 * @return void
 */
    Route::post('/token/refresh', [
        'middleware' => ['web', 'auth'],
        'uses' => 'TransientTokenController@refresh',
        'as' => 'passport.token.refresh',
    ]);

/**
 * Register the routes needed for managing clients.
 *
 * @return void
 */
//    Route::group(['middleware' => ['web', 'auth']], function ($router) {
//        Route::get('/clients', [
//            'uses' => 'ClientController@forUser',
//            'as' => 'passport.clients.index',
//        ]);
//
//        Route::post('/clients', [
//            'uses' => 'ClientController@store',
//            'as' => 'passport.clients.store',
//        ]);
//
//        Route::put('/clients/{client_id}', [
//            'uses' => 'ClientController@update',
//            'as' => 'passport.clients.update',
//        ]);
//
//        Route::delete('/clients/{client_id}', [
//            'uses' => 'ClientController@destroy',
//            'as' => 'passport.clients.destroy',
//        ]);
//    });



/**
 * Register the routes needed for managing personal access tokens.
 *
 * @return void
 */
//    Route::group(['middleware' => ['web', 'auth']], function ($router) {
//        Route::get('/scopes', [
//            'uses' => 'ScopeController@all',
//            'as' => 'passport.scopes.index',
//        ]);
//
//        Route::get('/personal-access-tokens', [
//            'uses' => 'PersonalAccessTokenController@forUser',
//            'as' => 'passport.personal.tokens.index',
//        ]);
//
//        Route::post('/personal-access-tokens', [
//            'uses' => 'PersonalAccessTokenController@store',
//            'as' => 'passport.personal.tokens.store',
//        ]);
//
//        Route::delete('/personal-access-tokens/{token_id}', [
//            'uses' => 'PersonalAccessTokenController@destroy',
//            'as' => 'passport.personal.tokens.destroy',
//        ]);
//    });
