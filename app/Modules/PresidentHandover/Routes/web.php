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

Route::prefix('presidenthandover')->middleware(['user', 'module', 'module.active:presidenthandover', 'module.maintenance:presidenthandover'])->group(function() {
    Route::get('/', 'PresidentHandoverController@showPage');

    Route::post('/', 'PresidentHandoverController@updatePresident');

});


Route::prefix('admin/presidenthandover')->middleware(['admin', 'module', 'module.active:presidenthandover', 'module.maintenance:presidenthandover'])->group(function() {
    Route::get('/', 'PresidentHandoverController@showAdminPage');
});
