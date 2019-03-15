<?php

namespace App\Modules\TierSelection\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TierSelection\Entities\Submission;
use App\Modules\TierSelection\Entities\Tier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        abort_if(Submission::countSubmissions($groupId) > 0, 400, 'You have already submitted your tier');

        $submission = new Submission([
            'group_id' => $groupId,
            'tier_id' => $request->input('tier_id')
        ]);

        abort_unless($submission->save(), 500, 'We were unable to save your selection.');
        return $submission;
    }
}