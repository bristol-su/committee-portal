<?php

namespace App\Modules\TierSelection\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TierSelection\Entities\Submission;
use App\Modules\TierSelection\Entities\Tier;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class TierSelectionController extends Controller
{
    public function showTierSelectionUserPage()
    {

        $this->authorize('tierselection.view');

        return view('tierselection::tier_selection');
    }

    public function showTierAdminPage()
    {
        $this->authorize('tierselection.view-admin');

        return view('tierselection::admin');
    }

    public function getTiers()
    {
        $this->authorize('tierselection.view');

        return Tier::all();
    }

    public function submitTier(Request $request)
    {
        $this->authorize('tierselection.submit');

        $request->validate([
            'tier_id' => 'required|exists:tierselection_tiers,id'
        ]);

        $groupId = getGroupID();

        Submission::getSubmissions($groupId)->each(function($submission) {
            $submission->delete();
        });

        $submission = new Submission([
            'group_id' => $groupId,
            'tier_id' => $request->input('tier_id'),
            'user_id' => Auth::user()->id
        ]);

        abort_unless($submission->save(), 500, 'We were unable to save your selection.');

        Event::dispatch('tierselection.submitted', $submission);

        return $submission;
    }

    public function getAllSelections()
    {
        $this->authorize('tierselection.view-admin');

        $submissions = Submission::with(['tier:id,name', 'user:id,forename,surname'])->get();
        $submissions->each(function(Submission &$submission) {
            $submission->group = Group::find($submission->group_id)->toArray();
        });

        return $submissions;
    }
}
