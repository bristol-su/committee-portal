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

Route::prefix('strategicplan')->middleware(['user', 'module', 'module.active:strategicplan', 'module.maintenance:strategicplan'])->group(function() {
    Route::get('/', 'StrategicPlanController@showUserPage')->name('strategicplan.user');

    Route::FileUploads('StrategicPlanController');

});

Route::prefix('admin/strategicplan')->middleware(['admin', 'module', 'module.active:strategicplan', 'module.maintenance:strategicplan'])->group(function() {
    Route::get('/', 'StrategicPlanController@showAdminPage')->name('strategicplan.admin');

    Route::get('/note-templates', 'StrategicPlanController@showNoteTemplatePage')->name('strategicplan.admin.note-template');

    Route::FileUploadsAdmin('StrategicPlanController');
});