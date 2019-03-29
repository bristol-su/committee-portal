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

Route::prefix('politicalactivity')->middleware(['user', 'module', 'module.active:politicalactivity', 'module.maintenance:politicalactivity'])->group(function() {
    Route::get('/', 'PoliticalActivityController@showUserPage');

    Route::post('/', 'PoliticalActivityController@confirm');

    Route::get('/complete', 'PoliticalActivityController@isComplete');

});

Route::prefix('admin/politicalactivity')->middleware(['admin', 'module', 'module.active:politicalactivity', 'module.maintenance:politicalactivity'])->group(function() {
    Route::get('/', 'PoliticalActivityController@showAdminPage');

    Route::get('/submissions', 'PoliticalActivityController@getSubmissions');

});
