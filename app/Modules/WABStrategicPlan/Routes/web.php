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

Route::prefix('wabstrategicplan')->middleware(['user', 'module', 'module.active:wabstrategicplan', 'module.maintenance:wabstrategicplan'])->group(function() {
    Route::get('/', 'WABStrategicPlanController@showUserPage');

    Route::FileUploads('WABStrategicPlanController');
});

Route::prefix('admin/wabstrategicplan')->middleware(['admin', 'module', 'module.active:wabstrategicplan', 'module.maintenance:wabstrategicplan'])->group(function() {
    Route::get('/', 'WABStrategicPlanController@showAdminPage');

    Route::get('/note-templates', 'WABStrategicPlanController@showNoteTemplatePage');

    Route::FileUploadsAdmin('WABStrategicPlanController');
});