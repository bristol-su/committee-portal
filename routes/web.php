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

# Control DB Internal API Routes
Route::middleware(['auth:web', 'committeerole', 'verified'])->prefix('/control-database/api')->group(function() {

    Route::get('positions', function(\Illuminate\Http\Request $request) {
        $position = \App\Packages\ControlDB\Models\Position::all();
        abort_if(!$position, 404);
        return $position->toArray();
    });

    Route::get('positions/{controlposition}', function(\Illuminate\Http\Request $request, \App\Packages\ControlDB\Models\Position $position) {
        return $position;
    });
});

# UnionCloud Routes

Route::middleware(['auth:web', 'committeerole', 'verified'])->prefix('/unioncloud/api')->group(function() {
    Route::get('/user', function(\Illuminate\Http\Request $request, \Twigger\UnionCloud\API\UnionCloud $unionCloud) {
        $request->validate([
            'uid' => 'required'
        ]);
        $params = $request->only(['uid']);
        $user = $unionCloud->users()->getByUID($params['uid'])->get()->first();
        return [
            'id' => $user->id,
            'forename' => $user->forename,
            'surname' => $user->surname,
            'email' => $user->email
        ];
    });

    Route::get('/user/search', function(\Illuminate\Http\Request $request, \Twigger\UnionCloud\API\UnionCloud $unionCloud) {
        $params = $request->only(['id', 'email']);
        return $unionCloud->users()->search($params)->get();

    });

});