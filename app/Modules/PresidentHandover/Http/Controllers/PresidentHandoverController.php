<?php

namespace App\Modules\PresidentHandover\Http\Controllers;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Rules\UnionCloudUIDExists;
use App\Traits\EditsControlPositions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class PresidentHandoverController extends Controller
{

    use EditsControlPositions;

    public function showPage()
    {
        $this->authorize('presidenthandover.view');
        if($this->presidentHasBeenSubmitted()) {
            return view('presidenthandover::presidenthandover_complete');
        }
        return view('presidenthandover::presidenthandover');
    }

    public function updatePresident(Request $request)
    {
        $this->authorize('presidenthandover.submit');

        abort_if($this->presidentHasBeenSubmitted(), 400, 'You have already submitted the new president.');

        $request->validate([
            'uid' => ['required', new UnionCloudUIDExists()]
        ]);

        $positionID = getExecutiveCommitteeRoleID();

        $committeeRole = new CommitteeRole();
        $committeeRole->student_id = $this->getStudentControlID($request->get('uid'));
        $committeeRole->group_id = getGroupID();
        $committeeRole->position_id = $positionID;
        $committeeRole->position_name = Position::find($positionID)->name;

        if (!$committeeRole->save()) {
            Log::error('Could not save committee role. Code '.$committeeRole->getResponse()->getStatusCode().', Message '.$committeeRole->getResponse()->getStatusPhrase());
            abort(500, 'We could not save your new committee position');
        }

        // Fetch the full committee role
        $committeeRole = CommitteeRole::find($committeeRole->id);


        Event::dispatch('presidenthandover.submitted', $committeeRole);
        return CommitteeRole::find($committeeRole->id);

    }

    public function showAdminPage()
    {
        $this->authorize('presidenthandover::view-admin');

        return view('presidenthandover::admin');
    }

    public function presidentHasBeenSubmitted()
    {
        $group = Group::find(getGroupID());
        $committee = CommitteeRole::allThrough($group);
        $positionId = getExecutiveCommitteeRoleID();
        return $committee->filter(function ($committeeMember) use ($positionId) {
                return $committeeMember->position_id === $positionId
                    && $committeeMember->committee_year === getReaffiliationYear();
            })->count() > 0;
    }
}
