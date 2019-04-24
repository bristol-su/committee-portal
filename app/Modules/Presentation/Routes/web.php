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

Route::prefix('presentation')->middleware(['user', 'module', 'module.active:presentation', 'module.maintenance:presentation'])->group(function() {
    Route::get('/', 'PresentationController@showUserPage')->name('presentation.user');

    Route::FileUploads('PresentationController');
});

Route::prefix('admin/presentation')->middleware(['admin', 'module', 'module.active:presentation', 'module.maintenance:presentation'])->group(function() {
    Route::get('/', 'PresentationController@showAdminPage')->name('presentation.admin');

    Route::get('/note-templates', 'PresentationController@showNoteTemplatePage')->name('presentation.admin.note-template');

    Route::FileUploadsAdmin('PresentationController');
});