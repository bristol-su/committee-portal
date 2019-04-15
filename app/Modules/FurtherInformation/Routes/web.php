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

Route::prefix('furtherinformation')->middleware(['user', 'module', 'module.active:furtherinformation', 'module.maintenance:furtherinformation'])->group(function() {
    Route::get('/', 'FurtherInformationController@showFurtherInformation')->name('furtherinformation.user');
});

Route::prefix('admin/furtherinformation')->middleware(['admin', 'module', 'module.active:furtherinformation', 'module.maintenance:furtherinformation'])->group(function() {
    Route::get('/', 'FurtherInformationController@showFurtherInformationAdmin')->name('furtherinformation.admin');
});