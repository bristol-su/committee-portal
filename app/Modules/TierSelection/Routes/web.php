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

Route::prefix('tierselection')->middleware(['user', 'module', 'module.status:tierselection'])->group(function() {
    Route::get('/', 'TierSelectionController@showTierSelectionUserPage');
    Route::post('/', 'TierSelectionController@submitTier');
});

Route::prefix('tierselection/api')->middleware(['user', 'module', 'module.status:tierselection'])->group(function() {
    Route::get('/tiers', 'TierSelectionController@getTiers');
});
