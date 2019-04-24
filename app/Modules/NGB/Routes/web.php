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

Route::prefix('ngb')->middleware(['user', 'module', 'module.active:ngb', 'module.maintenance:ngb'])->group(function() {
    Route::get('/', 'NGBController@showUserPage')->name('ngb.user');
    Route::post('/', 'NGBController@confirm');

    Route::get('/complete', 'NGBController@isComplete');
});

Route::prefix('admin/ngb')->middleware(['admin', 'module', 'module.active:ngb', 'module.maintenance:ngb'])->group(function() {
    Route::get('/', 'NGBController@showAdminPage')->name('ngb.admin');
    Route::get('/submissions', 'NGBController@getSubmissions');
});
