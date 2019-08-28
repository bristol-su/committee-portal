<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes(['verify' => true]);
Route::middleware(['auth:web', 'verified'])
    ->get('/password/set', 'Auth\VerificationController@showResetPasswordForm');

// Welcome Route
Route::middleware('guest')->get('/', 'PortalController@guestView');

// Settings routes
Route::prefix('settings')->namespace('Settings')->group(function () {
    Route::get('/', 'SettingsController@index')->name('settings');

    Route::resource('activity', 'ActivityController')->only(['index', 'create', 'show']);
    Route::resource('logic', 'LogicController')->only(['index', 'show', 'create']);

    Route::prefix('/activity/{activity}')->group(function () {
        Route::resource('module_instance', 'ModuleInstanceController')->only(['show', 'create']);
    });
});

// Portal Routes
Route::middleware('portal')
    ->namespace('Pages')
    ->group(function () {
        Route::get('/portal', 'PortalController@portal')->name('portal');
        Route::get('/{activity_slug}', 'ActivityController@participant');
        Route::get('/admin/{activity_slug}', 'ActivityController@administrator');
    });
