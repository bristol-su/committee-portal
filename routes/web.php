<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes(['verify' => true]);
Route::middleware(['auth:web', 'verified'])
    ->get('/password/set', 'Auth\VerificationController@showResetPasswordForm');
Route::middleware(['auth:web', 'verified'])->group(function() {
    Route::get('/login/role/{activity_slug}', 'Auth\LogIntoRoleController@show')->name('login.role');
    Route::post('/login/role/{activity_slug}', 'Auth\LogIntoRoleController@login');
    Route::get('/login/group/{activity_slug}', 'Auth\LogIntoGroupController@show')->name('login.group');
    Route::post('/login/group/{activity_slug}', 'Auth\LogIntoGroupController@login');
    Route::get('/login/user/{activity_slug}', 'Auth\LogIntoUserController@show')->name('login.user');
    Route::post('/login/user/{activity_slug}', 'Auth\LogIntoUserController@login');
});



// Settings routes
Route::namespace('Settings')->group(function () {
    Route::get('/settings', 'SettingsController@index')->name('settings');

    Route::resource('activity', 'ActivityController')->only(['index', 'create', 'show']);
    Route::resource('logic', 'LogicController')->only(['index', 'show', 'create']);

    Route::prefix('/activity/{activity}')->group(function () {
        Route::resource('module_instance', 'ModuleInstanceController')->only(['show', 'create']);
        Route::prefix('/module_instance/{module_instance}')->group(function() {
            Route::resource('action', 'ActionController')->only(['show', 'create']);
        });
    });

});

// Portal Routes
Route::namespace('Pages')->group(function () {
    Route::middleware('guest')->get('/', 'GuestController@index');
    Route::middleware('portal')->group(function() {
        Route::get('/portal', 'PortalController@portal')->name('portal');
        Route::get('/a', 'PortalController@administrator')->name('administrator');
        Route::get('/p', 'PortalController@participant')->name('participant');
        Route::middleware('activity')->group(function() {
            Route::middleware('administrator')->get('/a/{activity_slug}', 'ActivityController@administrator')->name('administrator.activity');
            Route::middleware('participant')->get('/p/{activity_slug}', 'ActivityController@participant')->name('participant.activity');
        });
    });

});
