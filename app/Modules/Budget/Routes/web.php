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

Route::prefix('budget')->middleware(['user', 'module', 'module.status:budget'])->group(function() {
    Route::get('/', 'BudgetController@showUserPage');

    Route::FileUploads('BudgetController');
});

Route::prefix('admin/budget')->middleware(['admin', 'module', 'module.status:budget'])->group(function() {
    Route::get('/', 'BudgetController@showAdminPage');

    Route::get('/note-templates', 'BudgetController@showNoteTemplatePage');

    Route::FileUploadsAdmin('BudgetController');
});