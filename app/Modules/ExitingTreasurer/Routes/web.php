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

    Route::get('/', 'ExitingTreasurerController@showUserPage')->name('exitingtreasurer.user');
    Route::get('/complete', 'ExitingTreasurerController@isComplete');
    Route::post('/complete/{exitingtreasurer_submission}', 'ExitingTreasurerController@markAsComplete');

    Route::get('/submissions', 'ExitingTreasurerController@submissions');
    Route::get('/download-report/{id}', 'ExitingTreasurerController@downloadReport');

    Route::post('/{id?}', 'ExitingTreasurerController@newSubmission');
    Route::get('/documents', 'ExitingTreasurerController@getGroupDocuments');
    Route::post('post-note/{id}', 'ExitingTreasurerController@postNote');
    Route::get('/download/{id}', 'ExitingTreasurerController@downloadTreasurerDocument');


    Route::prefix('api')->namespace('Api')->group(function() {
        Route::prefix('expense-claims')->group(function() {
            Route::get('/{exitingtreasurer_expense_claim}', 'ExitingTreasurerExpenseClaimController@get');
            Route::post('/', 'ExitingTreasurerExpenseClaimController@create');
            Route::delete('/{exitingtreasurer_expense_claim}', 'ExitingTreasurerExpenseClaimController@delete');
        });

        Route::prefix('invoices')->group(function() {
            Route::get('/{exitingtreasurer_invoice}', 'ExitingTreasurerInvoiceController@get');
            Route::post('/', 'ExitingTreasurerInvoiceController@create');
            Route::delete('/{exitingtreasurer_invoice}', 'ExitingTreasurerInvoiceController@delete');
        });

        Route::prefix('missing-i-and-e')->group(function() {
            Route::get('/{exitingtreasurer_missing_i_and_e}', 'ExitingTreasurerMissingIAndEController@get');
            Route::post('/', 'ExitingTreasurerMissingIAndEController@create');
            Route::delete('/{exitingtreasurer_missing_i_and_e}', 'ExitingTreasurerMissingIAndEController@delete');
        });

        Route::prefix('correction')->group(function() {
            Route::get('/{exitingtreasurer_correction}', 'ExitingTreasurerCorrectionController@get');
            Route::post('/', 'ExitingTreasurerCorrectionController@create');
            Route::delete('/{exitingtreasurer_correction}', 'ExitingTreasurerCorrectionController@delete');
        });
    });
});

Route::prefix('admin/exitingtreasurer')->middleware(['admin', 'module', 'module.active:exitingtreasurer', 'module.maintenance:exitingtreasurer'])->group(function() {

    Route::get('/', 'ExitingTreasurerController@showAdminPage')->name('exitingtreasurer.admin');

    Route::post('/upload/{exitingtreasurer_document}', 'ExitingTreasurerController@uploadDocument');

    Route::delete('/documents/{exitingtreasurer_document}', 'ExitingTreasurerController@deleteDocument');

    Route::get('retrieve-documents', 'ExitingTreasurerController@getDocuments');

    Route::post('post-note/{id}', 'ExitingTreasurerController@adminPostNote');

    Route::get('/submissions', 'ExitingTreasurerController@allSubmissions');

    Route::get('/download/{id}', 'ExitingTreasurerController@adminDownloadTreasurerDocument');

    Route::get('/download-report/{id}', 'ExitingTreasurerController@adminDownloadReport');

    /* Note template routes */

    Route::get('/retrieve-note-templates', 'ExitingTreasurerController@adminGetNoteTemplates');

    Route::post('/create-note-template', 'ExitingTreasurerController@adminCreateNoteTemplate');

    Route::post('/update-note-tempate/{id}', 'ExitingTreasurerController@adminUpdateNoteTemplate');

    Route::delete('/note-template/{id}', 'ExitingTreasurerController@adminDeleteNoteTemplate');


    /* Upload Request Routes */

    Route::prefix('upload-request')->group(function() {
        Route::get('groups', 'UploadRequestController@groups');
        Route::post('/', 'UploadRequestController@createRequest');
    });

});
