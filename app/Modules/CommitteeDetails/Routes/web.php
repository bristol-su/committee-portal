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
\Illuminate\Support\Facades\Route::prefix('committeedetails')->middleware(['auth', 'committeerole'])->group(function() {
    Route::get('/', 'CommitteeDetailsController@showUserForm');
    Route::post('/add', 'CommitteeDetailsController@addCommittee');
    Route::post('/', 'CommitteeDetailsController@submitCommittee');
    Route::delete('/delete/{committeedetails_committee}', 'CommitteeDetailsController@deleteCommittee');
    Route::get('/unioncloud/user/search', function(\Illuminate\Http\Request $request, \App\Packages\UnionCloud\UnionCloudInterface $unionCloud) {
        $request->validate([
            'q' => 'required:string'
        ]);
        $q = $request->input('q');

        return $unionCloud->getAccountSearchDetails($q);

    });

    Route::get('/control/positions/getall', function(\Illuminate\Http\Request $request, \App\Packages\ControlDB\ControlDBInterface $controlDB) {
        $positions = collect(\App\Packages\ControlDB\Models\Position::all()->toArray());
        $options = [];
        $positions->whereIn('id', config('committeedetails.all_positions'))->each(function($position) use (&$options) {
            $options[] = [
                'value' => $position['id'],
                'label' => $position['name']
            ];
        });
        return $options;
    });

    Route::get('/api/group_committee', function(\Illuminate\Http\Request $request) {
        $groupID = \Auth::guard('committee-role')->user()->group->id;
        return App\Modules\CommitteeDetails\Entities\Committee::getGroupCommittee($groupID);
    });

});