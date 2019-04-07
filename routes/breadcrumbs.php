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


Route::middleware('user')->group(function () {
    Route::get('/portal', 'PortalController@index')->name('portal');
});


Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/', 'AdminController@showAdminDashboard');

    Route::get('/settings', 'AdminSettingsController@showSettingsPage');

    Route::get('/settings/admin-users', 'AdminSettingsController@showAdminUsersPage');

    Route::get('/settings/roles-permissions', 'AdminSettingsController@showRolesAndPermissionsPage');
});
