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

Route::prefix('admin/reaffiliation-stats')->middleware(['admin', 'module', 'module.active:reaffiliationstats', 'module.maintenance:reaffiliationstats'])->group(function() {
    Route::get('/', 'ReaffiliationStatsController@showAdminPage')->name('reaffiliationstats.admin');

    Route::get('/stats', 'ReaffiliationStatsController@getStats');
});
