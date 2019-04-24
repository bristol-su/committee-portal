<?php

namespace App\Modules\CharitableGiving\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CharitableGiving\Entities\Submission;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CharitableGivingController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('charitablegiving.view');

        return view('charitablegiving::charitablegiving');
    }

    public function showAdminPage()
    {
        $this->authorize('charitablegiving.view-admin');

        return view('charitablegiving::admin');
    }

    public function confirm()
    {
        $this->authorize('charitablegiving.submit');

        $user = Auth::user();

        if($submission = Submission::create([
            'group_id' => $user->getCurrentRole()->group->id,
            'user_id' => $user->id,
            'position_id' => $user->getCurrentRole()->position->id,
            'year' => getReaffiliationYear()
        ])) {
            Event::dispatch('charitablegiving.submitted', $submission);
        }
    }

    /**
     * Check if the user has confirmed this already
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function isComplete()
    {
        $user = Auth::user();

        $count = Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => $user->getCurrentRole()->group->id,
        ])->count();

        if($count > 0) {
            return response('', 200);
        }
        return response('', 400);
    }

    public function getSubmissions()
    {
        $this->authorize('charitablegiving.view-admin');

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
