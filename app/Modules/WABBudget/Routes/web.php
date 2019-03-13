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
    Route::get('/', 'WABBudgetController@showUserPage');

    Route::FileUploads('WABBudgetController');
});

Route::prefix('admin/wabbudget')->middleware(['admin', 'module', 'module.active:wabbudget', 'module.maintenance:wabbudget'])->group(function() {
    Route::get('/', 'WABBudgetController@showAdminPage');

    Route::get('/note-templates', 'WABBudgetController@showNoteTemplatePage');

    Route::FileUploadsAdmin('WABBudgetController');
});