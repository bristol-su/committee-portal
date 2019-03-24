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

Route::prefix('groupinfo')->middleware(['user', 'module', 'module.active:groupinfo', 'module.maintenance:groupinfo'])->group(function() {
    Route::get('/', 'GroupInfoController@showPage');
    Route::post('/', 'GroupInfoController@changeInformation');
    Route::get('/questions', 'GroupInfoController@getQuestions');
});

Route::prefix('admin/groupinfo')->middleware(['admin', 'module', 'module.active:groupinfo', 'module.maintenance:groupinfo'])->group(function() {
    Route::get('/', 'GroupInfoController@showAdminPage');
});