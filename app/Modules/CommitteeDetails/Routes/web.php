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

\Illuminate\Support\Facades\Route::prefix('committeedetails')->middleware('control')->group(function() {
    Route::get('/', 'CommitteeDetailsController@showUserForm');
    Route::post('/add', 'CommitteeDetailsController@addCommittee');
    Route::post('/', 'CommitteeDetailsController@submitCommittee');
});
