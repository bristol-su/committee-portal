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
Route::middleware('auth:api')->group(function() {
    Route::apiResource('activity', 'ActivityController')->only(['store']);
    Route::apiResource('filter', 'FilterController')->only(['index']);
    Route::apiResource('filter_instances', 'FilterInstanceController')->only(['store']);
    Route::apiResource('logic', 'LogicController')->only(['index', 'show', 'store']);
    Route::apiResource('module', 'ModuleController')->only(['index']);
    Route::apiResource('module_instance_permission', 'ModuleInstancePermissionController')->only(['show', 'store', 'update']);
    Route::apiResource('module_instance_setting', 'ModuleInstanceSettingController')->only(['show', 'store', 'update']);
    Route::apiResource('module_instance', 'ModuleInstanceController')->only(['store']);

    Route::namespace('Relationships')->group(function() {
        Route::get('/activity/{activity}/module_instances', 'ActivityModuleInstancesController@index');

        Route::get('/logic/{logic}/filters', 'LogicFiltersController@index');
        Route::get('/logic/{logic}/audience', 'LogicAudienceController@index');

        Route::get('/me/roles', 'MeRolesController@index');
        Route::get('/me/roles/current', 'MeRolesController@currentRole');

    });

});
