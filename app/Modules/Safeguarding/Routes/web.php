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

Route::prefix('safeguarding')->middleware(['user', 'module', 'module.active:safeguarding', 'module.maintenance:safeguarding'])->group(function() {
    Route::get('/', 'SafeguardingController@showUserPage')->name('safeguarding.user');
    Route::get('/questions', 'SafeguardingQuestionController@get');
    Route::post('/questions', 'SafeguardingQuestionController@verify');
    Route::post('/completed', 'SafeguardingController@isComplete');

});

Route::prefix('admin/safeguarding')->middleware(['admin', 'module', 'module.active:safeguarding', 'module.maintenance:safeguarding'])->group(function() {
    Route::get('/', 'SafeguardingController@showAdminPage')->name('safeguarding.admin');
    Route::get('/submissions', 'SafeguardingController@getSubmissions');

});
