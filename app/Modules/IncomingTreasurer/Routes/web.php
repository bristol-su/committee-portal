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

Route::prefix('incomingtreasurer')->middleware(['user', 'module', 'module.active:incomingtreasurer', 'module.maintenance:incomingtreasurer'])->group(function() {
    Route::get('/', 'IncomingTreasurerController@showUserPage')->name('incomingtreasurer.user');
    Route::get('/questions', 'IncomingTreasurerQuestionController@get');
    Route::post('/questions', 'IncomingTreasurerQuestionController@verify');
    Route::post('/completed', 'IncomingTreasurerController@isComplete');
});

Route::prefix('admin/incomingtreasurer')->middleware(['admin', 'module', 'module.active:incomingtreasurer', 'module.maintenance:incomingtreasurer'])->group(function() {
    Route::get('/', 'IncomingTreasurerController@showAdminPage')->name('incomingtreasurer.admin');
    Route::get('/submissions', 'IncomingTreasurerController@getSubmissions');

});