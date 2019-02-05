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

\Illuminate\Support\Facades\Route::prefix('committeedetails')->middleware('control')->group(function() {
    Route::get('/', 'CommitteeDetailsController@showUserForm');
    Route::post('/add', 'CommitteeDetailsController@addCommittee');
    Route::post('/', 'CommitteeDetailsController@submitCommittee');

    Route::get('/unioncloud/user/search', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'id' => 'required_without:email',
            'email' => 'required_without:id',
        ]);

        $unioncloud = app()->make('Twigger\UnionCloud\API\UnionCloud');

        try {
            $users = $unioncloud->users()->search($request->only(['id', 'email']))->get()->toArray();
            if(count($users) === 0)
            {
                throw new \Twigger\UnionCloud\API\Exception\Resource\ResourceNotFoundException();
            }
        } catch (\Twigger\UnionCloud\API\Exception\Resource\ResourceNotFoundException $exception) {
            return response('The user couldn\'t be found.', 404);
        }

        $reducedUser = [];

        foreach($users as $user)
        {
            $reducedUser[] = [
                'uid' => $user->uid,
                'name' => $user->forename.' '.$user->surname,
                'email' => $user->email
            ];
        }

        return $reducedUser;
    });
});
