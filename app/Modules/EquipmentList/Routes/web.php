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

Route::prefix('equipmentlist')->middleware(['user', 'module', 'module.active:equipmentlist', 'module.maintenance:equipmentlist'])->group(function() {
    Route::get('/', 'EquipmentListController@showUserPage')->name('equipmentlist.user');
});

Route::prefix('admin/equipmentlist')->middleware(['admin', 'module', 'module.active:equipmentlist', 'module.maintenance:equipmentlist'])->group(function() {
    Route::get('/', 'EquipmentListController@showAdminPage')->name('equipmentlist.user');
});