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

// Authentication Routes
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
Route::middleware(['auth:web', 'verified'])
    ->get('/password/set', 'Auth\VerificationController@showResetPasswordForm');

// Welcome Route
Route::middleware('guest')->get('/', 'PortalController@guestView');


Route::middleware('user')->group(function () {
    // Portal Dashboard Route
    Route::get('/portal', 'PortalController@default')->name('portal');
    Route::get('/{event_slug}', 'PortalController@index');
    Route::get('/admin/{event_slug}', 'PortalController@admin');

    Route::post('/login/position', 'PortalController@logIntoCommitteeRole');


});


Route::prefix('admin')->group(function () {


    Route::prefix('settings')->group(function() {
        Route::get('/', 'AdminSettingsController@showSettingsPage')->name('admin.settings');
        Route::resource('events', 'Settings\EventController');
        Route::resource('logic', 'Settings\LogicController');
        Route::get('/events/{event}/moduleinstance', 'Settings\EventController@moduleInstances');
        Route::get('modules', 'Settings\ModuleController@index');
        Route::get('modules/{module}/settings', 'Settings\ModuleController@settings');
        Route::get('modules/{module}/permissions', 'Settings\ModuleController@permissions');
        Route::resource('moduleinstance', 'Settings\ModuleInstanceController');
        Route::resource('moduleinstance/{module_instance}/settings', 'Settings\ModuleInstanceSettingsController');
        Route::resource('moduleinstance/{module_instance}/permissions', 'Settings\ModuleInstancePermissionsController');
    });


    // View as Student routes
    Route::middleware('can:view-as-student')->post('/login/group', 'PortalController@logIntoGroup');

    Route::middleware('can:view-as-student')->post('/logout/group', 'PortalController@logoutOfGroup');
});

# Control DB Internal API Routes
Route::middleware('user')->prefix('/control-database/api')->group(function () {

    Route::get('available_committee_roles', 'ControlController@getAvailableCommitteeRoles');

    Route::get('positions', 'ControlController@getPositions');

    Route::get('positions/{controlposition}', 'ControlController@getPosition');

    Route::get('position_student_groups', 'ControlController@getPositionStudentGroups');

});

Route::prefix('/control-database/api')->group(function() {
    Route::get('groups', 'ControlController@getAllGroups');
});

# UnionCloud Routes

Route::prefix('/unioncloud/api')->group(function () {

    Route::get('/user', 'UnionCloudController@getUserByUID');

    Route::get('user/multisearch', 'UnionCloudController@searchOneTerm');

});