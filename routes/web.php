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
Route::middleware('guest')->get('/', function () { return view('welcome'); });

// Portal Dashboard Route
Route::middleware(['auth:web', 'verified'])->get('/portal', 'PortalController@index')->name('portal');
