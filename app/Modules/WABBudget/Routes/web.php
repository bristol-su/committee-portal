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

Route::prefix('wabbudget')->middleware(['user', 'module', 'module.active:wabbudget', 'module.maintenance:wabbudget'])->group(function() {
    Route::get('/', 'WABBudgetController@showUserPage')->name('wabbudget.user');

    Route::FileUploads('WABBudgetController');
});

Route::prefix('admin/wabbudget')->middleware(['admin', 'module', 'module.active:wabbudget', 'module.maintenance:wabbudget'])->group(function() {
    Route::get('/', 'WABBudgetController@showAdminPage')->name('wabbudget.admin');

    Route::get('/note-templates', 'WABBudgetController@showNoteTemplatePage')->name('wabbudget.admin.note-template');

    Route::FileUploadsAdmin('WABBudgetController');
});