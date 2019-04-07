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

Route::prefix('executivesummary')->middleware(['user', 'module', 'module.active:executivesummary', 'module.maintenance:executivesummary'])->group(function() {

    Route::get('/', 'ExecutiveSummaryController@showUserPage')->name('executivesummary.user');

    Route::FileUploads('ExecutiveSummaryController');

});

Route::prefix('admin/executivesummary')->middleware(['admin', 'module', 'module.active:executivesummary', 'module.maintenance:executivesummary'])->group(function() {
    Route::get('/', 'ExecutiveSummaryController@showAdminPage')->name('executivesummary.admin');

    Route::get('/note-templates', 'ExecutiveSummaryController@showNoteTemplatePage')->name('executivesummary.admin.note-template');

    Route::FileUploadsAdmin('ExecutiveSummaryController');
});