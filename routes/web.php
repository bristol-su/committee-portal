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
Auth::routes(['verify' => true]);

// Welcome Route
Route::middleware('guest')->get('/', 'PortalController@guestView');

Route::middleware(['auth:web', 'verified'])
    ->get('/password/set', 'Auth\VerificationController@showResetPasswordForm');

Route::middleware('user')->group(function () {
    // Portal Dashboard Route
    Route::get('/portal', 'PortalController@index')->name('portal');

    Route::post('/login/position', 'PortalController@logIntoCommitteeRole');


});


Route::middleware('admin')->group(function () {

    Route::get('/admin', 'AdminController@showAdminDashboard');

    Route::middleware('can-view-as-student')->post('/login/group', 'PortalController@logIntoGroup');

    Route::middleware('can-view-as-student')->post('/logout/group', 'PortalController@logoutOfGroup');
});

# Control DB Internal API Routes
Route::middleware('user')->prefix('/control-database/api')->group(function () {

    Route::get('available_committee_roles', 'ControlController@getAvailableCommitteeRoles');

    Route::get('positions', 'ControlController@getPositions');

    Route::get('positions/{controlposition}', 'ControlController@getPosition');

    Route::get('position_student_groups', 'ControlController@getPositionStudentGroups');

});

Route::middleware('admin')->prefix('/control-database/api')->group(function() {
    Route::get('groups', 'ControlController@getAllGroups');
});

# UnionCloud Routes

Route::middleware('user')->prefix('/unioncloud/api')->group(function () {

    Route::get('/user', 'UnionCloudController@getUserByUID');

    Route::get('user/multisearch', 'UnionCloudController@searchOneTerm');

});