<?php

namespace App\Modules\NGB\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\NGB\Entities\Submission;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class NGBController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('ngb.view');

        return view('ngb::ngb');
    }

    public function showAdminPage()
    {
        $this->authorize('ngb.view-admin');

        return view('ngb::admin');
    }

    public function confirm(Request $request)
    {
        $this->authorize('ngb.submit');

        $request->validate([
            'statement' => 'string|min:3'
        ]);

        $user = Auth::user();

        if($submission = Submission::create([
            'group_id' => $user->getCurrentRole()->group->id,
            'user_id' => $user->id,
            'position_id' => $user->getCurrentRole()->position->id,
            'year' => getReaffiliationYear(),
            'statement' => $request->input('statement')
        ])) {
            Event::dispatch('ngb.submitted', $submission);
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

        $submission = Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => $user->getCurrentRole()->group->id,
        ])->get();

        if($submission->count() > 0) {
            return response($submission->last(), 200);
        }
        return response('', 400);
    }

    public function getSubmissions()
    {
        $this->authorize('ngb.view-admin');

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
