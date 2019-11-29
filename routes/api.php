<?php

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
Route::middleware(['auth', 'verified'])->group(function() {
    Route::apiResource('activity', 'ActivityController')->only(['store']);
    Route::apiResource('filter', 'FilterController')->only(['index']);
    Route::apiResource('filter-instances', 'FilterInstanceController')->only(['store']);
    Route::apiResource('logic', 'LogicController')->only(['index', 'show', 'store']);
    Route::apiResource('module', 'ModuleController')->only(['index', 'show']);
    Route::apiResource('module-instance-permission', 'ModuleInstancePermissionController')->only(['show', 'store', 'update']);
    Route::apiResource('module-instance-setting', 'ModuleInstanceSettingController')->only(['show', 'store', 'update']);
    Route::apiResource('module-instance', 'ModuleInstanceController')->only(['store']);
    Route::apiResource('action', 'ActionController')->only(['index']);
    Route::apiResource('action-instance', 'ActionInstanceController')->only(['store', 'update']);
    Route::apiResource('action-instance-field', 'ActionInstanceFieldController')->only(['store', 'update']);
    Route::apiResource('site-permission', 'SitePermissionController')->only('index', 'show');
    Route::apiResource('group', 'GroupController')->only(['show']);
    Route::apiResource('role', 'RoleController')->only(['show']);
    Route::apiResource('completion-condition-instance', 'CompletionConditionInstanceController')->only(['store']);
    Route::apiResource('activity-instance', 'ActivityInstanceController')->only(['store']);

    Route::namespace('Relationships')->group(function() {
        Route::get('/activity/{activity}/module-instance', 'ActivityModuleInstancesController@index');

        Route::get('/logic/{logic}/filters', 'LogicFiltersController@index');
        Route::get('/logic/{logic}/audience', 'LogicAudienceController@index');

        Route::get('/me/roles', 'MeRolesController@index');

        Route::get('/site-permission/{site_permission}/user', 'SitePermissionUserController@index');
        Route::post('/site-permission/{site_permission}/user/{control_user_id}', 'SitePermissionUserController@store');
        Route::delete('/site-permission/{site_permission}/user/{control_user_id}', 'SitePermissionUserController@delete');

    });

    Route::namespace('Control')->prefix('control')->group(function() {
        Route::apiResource('user', 'UserController')->only(['index']);
    });

});
