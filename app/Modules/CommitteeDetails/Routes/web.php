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
\Illuminate\Support\Facades\Route::prefix('committeedetails')->middleware(['user', 'module', 'module.status:committeedetails'])->group(function() {
    Route::get('/', 'CommitteeDetailsController@showUserPage');
    Route::post('/', 'CommitteeDetailsController@addUserToControl');
    Route::post('/{positionStudentGroupID}', 'CommitteeDetailsController@updateUserInControl');
    Route::delete('/{positionStudentGroupID}', 'CommitteeDetailsController@deleteCommitteeRoleFromControl');
    Route::get('/positions', 'CommitteeDetailsController@getPositions');
});