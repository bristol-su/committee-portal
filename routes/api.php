<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('logic', 'LogicController');
Route::apiResource('module_instance_setting', 'ModuleInstanceSettingController');
Route::apiResource('module_instance_permission', 'ModuleInstancePermissionController');
Route::apiResource('activity', 'ActivityController');
Route::apiResource('filter_instances', 'FilterInstanceController');
Route::namespace('Relationships')->group(function() {
    Route::get('/activity/{activity}/module_instances', 'ActivityModuleInstancesController@index');

    Route::get('/logic/{logic}/filters', 'LogicFiltersController@index');
});
