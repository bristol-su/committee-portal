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

Route::prefix('externalaccounts')->middleware(['user', 'module', 'module.active:externalaccounts', 'module.maintenance:externalaccounts'])->group(function() {
    Route::get('/', 'ExternalAccountsController@showUserPage')->name('externalaccounts.user');

    Route::prefix('submission')->group(function() {
        Route::post('/', 'SubmissionController@create');
        Route::get('/', 'SubmissionController@get');
    });

    Route::prefix('statement')->group(function() {
        Route::post('/', 'StatementController@create');
        Route::get('/', 'StatementController@get');

    });

    Route::prefix('account')->group(function() {
        Route::post('/', 'AccountController@create');
        Route::get('/{externalaccounts_account}', 'AccountController@get');
        Route::get('/', 'AccountController@getAll');


        Route::prefix('closure')->group(function() {
            Route::post('/{externalaccounts_account}', 'ClosureController@create');
            Route::get('/{externalaccounts_closure}', 'ClosureController@get');
        });

        Route::prefix('eoy')->group(function() {
            Route::post('/{externalaccounts_account}', 'EOYController@create');
            Route::get('/{externalaccounts_eoy}', 'EOYController@get');
        });

    });



});

Route::prefix('admin/externalaccounts')->middleware(['admin', 'module', 'module.active:externalaccounts', 'module.maintenance:externalaccounts'])->group(function() {
    Route::get('/', 'ExternalAccountsController@showAdminPage')->name('externalaccounts.admin');
});