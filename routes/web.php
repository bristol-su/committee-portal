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


Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/', 'AdminController@showAdminDashboard')->name('admin');

    Route::get('/stats', 'AdminController@getStats');

    Route::get('/settings', 'AdminSettingsController@showSettingsPage')->name('admin.settings');

    // Admin Users routes
    Route::get('/settings/admin-users', 'AdminSettingsController@showAdminUsersPage')->name('admin.settings.users');

    Route::get('/settings/admin-users/get-users', 'AdminSettingsController@getAdminUsers');

    Route::delete('/settings/admin-users/{user}/delete-user', 'AdminSettingsController@deleteAdminUsers');

    Route::post('/settings/admin-users/update/{user}', 'AdminSettingsController@updateUser');

    Route::post('/settings/admin-users/update', 'AdminSettingsController@createUser');

    Route::post('/settings/permissions/update/{user}', 'AdminSettingsController@updateAdminUserRolesAndPermissions');

    // Role and permission Routes

    Route::get('/settings/permissions/get', 'AdminSettingsController@getPermissions');

    Route::get('/settings/roles/get', 'AdminSettingsController@getRoles');

    Route::post('/settings/roles/update/{role}', 'AdminSettingsController@updateRole');

    Route::post('/settings/roles/update', 'AdminSettingsController@createRole');

    Route::delete('/settings/roles/{role}', 'AdminSettingsController@deleteRole');

    // Roles and Permissions
    Route::get('/settings/roles-permissions', 'AdminSettingsController@showRolesAndPermissionsPage')->name('admin.settings.roles-permissions');

    Route::post('/settings/roles-permissions/update/{role}', 'AdminSettingsController@updateRolesAndPermissions');

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

Route::middleware('admin')->prefix('/control-database/api')->group(function() {
    Route::get('groups', 'ControlController@getAllGroups');
});

# UnionCloud Routes

Route::middleware('user')->prefix('/unioncloud/api')->group(function () {

    Route::get('/user', 'UnionCloudController@getUserByUID');

    Route::get('user/multisearch', 'UnionCloudController@searchOneTerm');

});