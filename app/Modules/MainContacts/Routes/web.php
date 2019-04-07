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

Route::prefix('maincontacts')->middleware(['user', 'module', 'module.active:maincontacts', 'module.maintenance:maincontacts'])->group(function() {
    Route::get('/', 'MainContactsController@showPage')->name('maincontacts.user');

    Route::get('/contacts', 'MainContactsController@getContacts');
    Route::get('/committee', 'MainContactsController@getCommittee');

    Route::post('/', 'MainContactsController@updateContacts');
});

Route::prefix('/admin/maincontacts')->middleware(['admin', 'module', 'module.active:maincontacts', 'module.maintenance:maincontacts'])->group(function() {
    Route::get('/', 'MainContactsController@showAdminPage')->name('maincontacts.admin');
});