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

    Route::get('/unioncloud/user/search', function(\Illuminate\Http\Request $request, \App\Packages\UnionCloud\UnionCloudInterface $unionCloud) {
        $request->validate([
            'q' => 'required:string'
        ]);
        $q = $request->input('q');

        return $unionCloud->getAccountSearchDetails($q);

    });

    Route::get('/control/positions/getall', function(\Illuminate\Http\Request $request, \App\Packages\ControlDB\ControlDBInterface $controlDB) {

        return $controlDB->getPositions();

    });
});