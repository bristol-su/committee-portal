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
\Illuminate\Support\Facades\Route::prefix('committeedetails')->middleware(['user', 'module', 'module.active:committeedetails', 'module.maintenance:committeedetails'])->group(function() {
    Route::get('/', 'CommitteeDetailsController@showUserPage')->name('committeedetails.user');
    Route::post('/', 'CommitteeDetailsController@addUserToControl');
    Route::post('/{positionStudentGroupID}', 'CommitteeDetailsController@updateUserInControl');
    Route::delete('/{positionStudentGroupID}', 'CommitteeDetailsController@deleteCommitteeRoleFromControl');
    Route::get('/positions', 'CommitteeDetailsController@getPositions');
});

\Illuminate\Support\Facades\Route::prefix('admin/committeedetails')->middleware(['admin', 'module', 'module.active:committeedetails', 'module.maintenance:committeedetails'])->group(function() {
    Route::get('/', 'CommitteeDetailsController@showAdminPage')->name('committeedetails.admin');
});
