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

Route::prefix('libeldefamation')->middleware(['user', 'module', 'module.active:libeldefamation', 'module.maintenance:libeldefamation'])->group(function() {
    Route::get('/', 'LibelDefamationController@showUserPage');

    Route::post('/', 'LibelDefamationController@confirm');

    Route::get('/complete', 'LibelDefamationController@isComplete');

});

Route::prefix('admin/libeldefamation')->middleware(['admin', 'module', 'module.active:libeldefamation', 'module.maintenance:libeldefamation'])->group(function() {
    Route::get('/', 'LibelDefamationController@showAdminPage');
    Route::get('/submissions', 'LibelDefamationController@getSubmissions');

});
