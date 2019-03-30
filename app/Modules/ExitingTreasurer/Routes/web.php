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

use Illuminate\Support\Facades\Route;

Route::prefix('exitingtreasurer')->middleware(['user', 'module', 'module.active:exitingtreasurer', 'module.maintenance:exitingtreasurer'])->group(function() {

    Route::get('/', 'ExitingTreasurerController@showUserPage');

    Route::post('post-note/{id}', 'ExitingTreasurerController@postNote');

});

Route::prefix('admin/exitingtreasurer')->middleware(['admin', 'module', 'module.active:exitingtreasurer', 'module.maintenance:exitingtreasurer'])->group(function() {

    Route::get('/', 'ExitingTreasurerController@showAdminPage');

    Route::post('/upload/{exitingtreasurer_document}', 'ExitingTreasurerController@uploadDocument');

    Route::get('retrieve-documents', 'ExitingTreasurerController@getDocuments');

    Route::post('post-note/{id}', 'ExitingTreasurerController@adminPostNote');

    /* Note template routes */

    Route::get('/retrieve-note-templates', 'ExitingTreasurerController@adminGetNoteTemplates');

    Route::post('/create-note-template', 'ExitingTreasurerController@adminCreateNoteTemplate');

    Route::post('/update-note-tempate/{id}', 'ExitingTreasurerController@adminUpdateNoteTemplate');

    Route::delete('/note-template/{id}', 'ExitingTreasurerController@adminDeleteNoteTemplate');
});
