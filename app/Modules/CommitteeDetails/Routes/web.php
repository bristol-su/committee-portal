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

\Illuminate\Support\Facades\Route::prefix('committeedetails')->middleware('auth')->group(function() {
    Route::get('/', 'CommitteeDetailsController@showUserForm');
    Route::post('/add', 'CommitteeDetailsController@addCommittee');
    Route::post('/', 'CommitteeDetailsController@submitCommittee');

    Route::get('/unioncloud/user/search', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'q' => 'required:string'
        ]);
        $q = $request->input('q');

        $unioncloud = app()->make('App\Packages\UnionCloud\UnionCloudInterface');

        return $unioncloud->getAccountSearchDetails($q);

    });
});
