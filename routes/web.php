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

Route::middleware(['auth:web', 'verified'])->group(function()
{
    // Portal Dashboard Route
    Route::get('/portal', 'PortalController@index')->name('portal');

    Route::post('/login/position', function(\Illuminate\Http\Request $request) {
        if($request->has('position_id'))
        {
            Auth::user()->loginToPosition($request->get('position_id'));
            Toast::message('You\'re acting as '.Auth::user()->getCurrentPosition()['position_name'].' for group '.Auth::user()->getCurrentPosition()['group_name'], 'success', 'Logged in');
            return redirect()->route('portal');
        }
        return redirect()->route('portal')->withErrors(['login' => 'There was a problem logging into your group']);
    });
});
