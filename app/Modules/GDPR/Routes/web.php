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

Route::prefix('gdpr')->middleware(['user', 'module', 'module.active:gdpr', 'module.maintenance:gdpr'])->group(function() {
    Route::get('/', 'GDPRController@showUserPage')->name('gdpr.user');
});

Route::prefix('admin/gdpr')->middleware(['admin', 'module', 'module.active:gdpr', 'module.maintenance:gdpr'])->group(function() {
    Route::get('/', 'GDPRController@showAdminPage')->name('gdpr.admin');
});