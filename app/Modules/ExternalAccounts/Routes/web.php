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

Route::prefix('externalaccounts')->middleware(['user', 'module', 'module.active:externalaccounts', 'module.maintenance:externalaccounts'])->group(function() {
    Route::get('/', 'ExternalAccountsController@showUserPage')->name('externalaccounts.user');
});

Route::prefix('admin/externalaccounts')->middleware(['admin', 'module', 'module.active:externalaccounts', 'module.maintenance:externalaccounts'])->group(function() {
    Route::get('/', 'ExternalAccountsController@showAdminPage')->name('externalaccounts.admin');
});