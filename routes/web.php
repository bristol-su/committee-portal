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
    Route::resource('activity', 'ActivityController');
    Route::prefix('/activity/{activity}')->group(function() {
        Route::resource('module_instance', 'ModuleInstanceController');
    });
    Route::resource('logic', 'LogicController');

//
//
//    Route::resource('logic', 'Settings\LogicController');
//    Route::get('/activities/{activity}/moduleinstance', 'Settings\ActivityController@moduleInstances');
//    Route::get('modules', 'Settings\ModuleController@index');
//    Route::get('modules/{module}/settings', 'Settings\ModuleController@settings');
//    Route::get('modules/{module}/permissions', 'Settings\ModuleController@permissions');
//    Route::resource('moduleinstance', 'Settings\ModuleInstanceController');
//    Route::resource('moduleinstance/{module_instance}/settings', 'Settings\ModuleInstanceSettingsController');
//    Route::resource('moduleinstance/{module_instance}/permissions', 'Settings\ModuleInstancePermissionsController');
});

// Portal Routes
Route::middleware('portal')
    ->namespace('Pages')
    ->group(function () {
        Route::get('/portal', 'PortalController@portal')->name('portal');
        Route::get('/{activity_slug}', 'ActivityController@participant');
        Route::get('/admin/{activity_slug}', 'ActivityController@administrator');
    });







# Control DB Internal API Routes
Route::middleware('portal')->prefix('/control-database/api')->group(function () {

    Route::get('available_committee_roles', 'ControlController@getAvailableCommitteeRoles');

    Route::get('positions', 'ControlController@getPositions');

    Route::get('positions/{controlposition}', 'ControlController@getPosition');

    Route::get('position_student_groups', 'ControlController@getPositionStudentGroups');

});

Route::prefix('/control-database/api')->group(function () {
    Route::get('groups', 'ControlController@getAllGroups');
});

# UnionCloud Routes

Route::prefix('/unioncloud/api')->group(function () {

    Route::get('/user', 'UnionCloudController@getUserByUID');

    Route::get('user/multisearch', 'UnionCloudController@searchOneTerm');

});


// Routes to replace

Route::middleware('portal')->group(function () {
    Route::post('/login/position', 'PortalController@logIntoCommitteeRole');
});

Route::prefix('admin')->group(function () {
    // View as Student routes
    Route::middleware('can:view-as-student')->post('/login/group', 'PortalController@logIntoGroup');

    Route::middleware('can:view-as-student')->post('/logout/group', 'PortalController@logoutOfGroup');
});
