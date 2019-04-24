<?php

namespace App\Modules\Safeguarding\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Safeguarding\Entities\Submission;
use App\Packages\ControlDB\Models\Position;
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

    public function showAdminPage()
    {
        $this->authorize('safeguarding.view-admin');

        return view('safeguarding::admin');
    }

    public function getSubmissions()
    {
        $this->authorize('safeguarding.view-admin');
        $submissions = Submission::with('user:id,forename,surname')->get();
        $alteredSubmissions = [];
        $submissions->each(function(Submission $submission) use (&$alteredSubmissions) {
            $submissionPosition = $submission->position();
            $submission->position = ($submissionPosition instanceof Position ?  $submissionPosition->toArray() : $submissionPosition);
            $submission->group = $submission->group()->toArray();
            $alteredSubmissions[] = $submission;
        });
        return $alteredSubmissions;
    }

}
