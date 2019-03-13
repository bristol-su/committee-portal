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

Route::prefix('exitingtreasurer')->middleware(['user', 'module', 'module.active:exitingtreasurer', 'module.maintenance:exitingtreasurer'])->group(function() {
    Route::get('/', 'ExitingTreasurerController@index');
});
