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

Route::prefix('riskassessment')->middleware(['user', 'module', 'module.active:riskassessment', 'module.maintenance:riskassessment'])->group(function() {
    Route::get('/', 'RiskAssessmentController@showUserPage');

    Route::FileUploads('RiskAssessmentController');

});

Route::prefix('admin/riskassessment')->middleware(['admin', 'module', 'module.active:riskassessment', 'module.maintenance:riskassessment'])->group(function() {
    Route::get('/', 'RiskAssessmentController@showAdminPage');

    Route::get('/note-templates', 'RiskAssessmentController@showNoteTemplatePage');

    Route::FileUploadsAdmin('RiskAssessmentController');
});