<?php

use Illuminate\Support\Facades\Route;

// Laravel Authentication Routes
Auth::routes(['verify' => true]);

// Landing Page Route
Route::middleware('guest')->get('/', 'Pages\GuestController@index');

Route::middleware(['auth', 'verified'])->group(function() {

    // Custom Authentication Routes
    Route::get('/password/set', 'Auth\VerificationController@showResetPasswordForm');
    Route::get('/login/role/{activity_slug}', 'Auth\LogIntoRoleController@show')->name('login.role');
    Route::post('/login/role/{activity_slug}', 'Auth\LogIntoRoleController@login');
    Route::get('/login/group/{activity_slug}', 'Auth\LogIntoGroupController@show')->name('login.group');
    Route::post('/login/group/{activity_slug}', 'Auth\LogIntoGroupController@login');
    Route::get('/login/user/{activity_slug}', 'Auth\LogIntoUserController@show')->name('login.user');
    Route::post('/login/user/{activity_slug}', 'Auth\LogIntoUserController@login');
    Route::get('/login/admin/{activity_slug}', 'Auth\LogIntoAdminController@show')->name('login.admin');
    Route::post('/login/admin/{activity_slug}', 'Auth\LogIntoAdminController@login');

    Route::middleware(['nonmodule', 'can:view-settings'])->namespace('Settings')->group(function() {
        // Settings routes
        Route::get('/settings', 'SettingsController@index')->name('settings');
        Route::resource('activity', 'ActivityController')->only(['index', 'create', 'show']);
        Route::resource('logic', 'LogicController')->only(['index', 'show', 'create']);
        Route::resource('site-permission', 'SitePermissionController')->only(['index', 'show']);
        Route::prefix('/activity/{activity}')->group(function () {
            Route::resource('module-instance', 'ModuleInstanceController')->only(['show', 'create']);
            Route::prefix('/module-instance/{module_instance}')->group(function() {
                Route::resource('action', 'ActionController')->only(['show', 'create']);
            });
        });
    });


    // Portal Routes
    Route::namespace('Pages')->group(function () {
        Route::middleware('nonmodule')->group(function() {
            Route::get('/portal', 'PortalController@portal')->name('portal');
            Route::get('/a', 'PortalController@administrator')->name('administrator');
            Route::get('/p', 'PortalController@participant')->name('participant');
            Route::get('/activity/{activity}/progress', 'ActivityProgressController@index');

        });

        Route::middleware('activity')->group(function() {
            Route::middleware('administrator')->get('/a/{activity_slug}', 'ActivityController@administrator')->name('administrator.activity');
            Route::middleware('participant')->get('/p/{activity_slug}', 'ActivityController@participant')->name('participant.activity');
        });

    });

});
