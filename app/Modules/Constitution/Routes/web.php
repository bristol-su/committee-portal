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

Route::prefix('constitution')->middleware(['user', 'module', 'module.status:constitution'])->group(function() {
    Route::get('/', 'ConstitutionController@showUserPage');

    Route::FileUploads('ConstitutionController');

});

Route::prefix('admin/constitution')->middleware(['admin', 'module', 'module.status:constitution'])->group(function() {
    Route::get('/', 'ConstitutionController@showAdminPage');

    Route::get('/note-templates', 'ConstitutionController@showNoteTemplatePage');

    Route::FileUploadsAdmin('ConstitutionController');
});