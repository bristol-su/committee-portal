<?php

namespace App\Modules\PoliticalActivity\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\PoliticalActivity\Entities\Submission;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PoliticalActivityController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('politicalactivity.view');

        return view('politicalactivity::politicalactivity');
    }


    public function showAdminPage()
    {
        $this->authorize('politicalactivity.view-admin');

        return view('politicalactivity::admin');

    }

    public function confirm()
    {
        $this->authorize('politicalactivity.submit');

        $user = Auth::user();

        Submission::create([
            'group_id' => $user->getCurrentRole()->group->id,
            'user_id' => $user->id,
            'position_id' => $user->getCurrentRole()->position->id,
            'year' => getReaffiliationYear()
        ]);
    }

    /**
     * Check if the user has confirmed this already
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        $user = Auth::user();

        $count = \App\Modules\LibelDefamation\Entities\Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => $user->getCurrentRole()->group->id,
        ])->count();

        if($count > 0) {
            return response('', 200);
        }
        return response('', 503);
    }

    public function getSubmissions()
    {
        $this->authorize('politicalactivity.view-admin');

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
