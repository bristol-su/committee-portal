<?php

namespace App\Modules\IncomingTreasurer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\IncomingTreasurer\Entities\Submission;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IncomingTreasurerController extends Controller
{
    public function showUserPage() {
        $this->authorize('incomingtreasurer.view');

        return view('incomingtreasurer::incomingtreasurer');
    }

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        $count = Submission::where([
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'year' => getReaffiliationYear(),
        ])->count();
        if($count > 0) {
            return response('' ,200);
        }
        return response('', 400);
    }

    public function showAdminPage()
    {
        $this->authorize('incomingtreasurer.view-admin');

        return view('incomingtreasurer::admin');
    }

    public function getSubmissions()
    {
        $this->authorize('incomingtreasurer.view-admin');
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
