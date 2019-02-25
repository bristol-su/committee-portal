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

Route::middleware('user')->group(function () {
    // Portal Dashboard Route
    Route::get('/portal', 'PortalController@index')->name('portal');

    Route::post('/login/position', 'PortalController@logIntoCommitteeRole');

});

# Control DB Internal API Routes
Route::middleware('user')->prefix('/control-database/api')->group(function () {

    Route::get('positions', 'ControlController@getPositions');

    Route::get('positions/{controlposition}', 'ControlController@getPosition');

    Route::get('position_student_groups', 'ControlController@getPositionStudentGroups');

});

# UnionCloud Routes

Route::middleware('user')->prefix('/unioncloud/api')->group(function () {

    Route::get('/user', 'UnionCloudController@getUserByUID');

    Route::get('user/multisearch', 'UnionCloudController@searchOneTerm');

});