<?php

namespace App\Modules\Safeguarding\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Safeguarding\Entities\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SafeguardingController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('safeguarding.view');

        return view('safeguarding::safeguarding');
    }

    public function isComplete()
    {
        $count = Submission::where([
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'year' => getReaffiliationYear(),
        ])->count();
        if($count > 0) {
            return response('' ,200);
        }
        return response('', 403);
    }

}
