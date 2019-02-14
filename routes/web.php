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

Route::middleware(['auth:web', 'committeerole', 'verified'])->group(function()
{
    // Portal Dashboard Route
    Route::get('/portal', 'PortalController@index')->name('portal');

    Route::post('/login/position', function(\Illuminate\Http\Request $request) {
        if($request->has('committee_role_id'))
        {
            if(Auth::guard('committee-role')->attempt([
                'committee_role_id' => $request->input('committee_role_id'),
                'student_control_id' => Auth::user()->control_id
            ])) {
                \Toast::message('You\'re acting as '.Auth::guard('committee-role')->user()->position->name.' for group '.Auth::guard('committee-role')->user()->group->name, 'success', 'Logged in');

            } else {
                \Toast::message('Couldn\'t log you in', 'error', 'Error');
            }

        }
        return redirect()->route('portal');

    });
});
