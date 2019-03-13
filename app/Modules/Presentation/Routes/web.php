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

Route::prefix('presentation')->group(function() {
    Route::get('/', 'PresentationController@showUserPage');

    Route::FileUploads('PresentationController');

});

Route::prefix('admin/presentation')->middleware(['admin', 'module', 'module.active:wabstrategicplan', 'module.maintenance:presentation'])->group(function() {
    Route::get('/', 'PresentationController@showAdminPage');

    Route::get('/note-templates', 'PresentationController@showNoteTemplatePage');

    Route::FileUploadsAdmin('PresentationController');
});