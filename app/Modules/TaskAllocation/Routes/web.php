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

Route::prefix('taskallocation')->middleware(['user', 'module', 'module.status:taskallocation'])->group(function() {
    Route::get('/', 'TaskAllocationController@index');
});
