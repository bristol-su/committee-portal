<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use ActiveResource\ConnectionManager;
use App\Http\Controllers\Controller;
use App\PositionSetting;
use App\Modules\CommitteeDetails\Http\Middleware\LoadGroupPositionRequirementsIntoJavascript;
use App\Modules\CommitteeDetails\Rules\PositionIsAllowed;
use App\Modules\CommitteeDetails\Rules\PositionMustBeEmpty;
use App\Modules\CommitteeDetails\Rules\IsStudentAvailable;
use App\Traits\EditsControlPositions;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use App\Rules\UnionCloudUIDExists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class CommitteeDetailsController extends Controller
{

    use EditsControlPositions;



    /*
    |--------------------------------------------------------------------------
    | Show pages
    |--------------------------------------------------------------------------
    |
    | Methods to show pages for users and admins
    |
    */

    /**
     * Show the user page for changing committee
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showUserPage()
    {
        $this->authorize('committeedetails.view');

        return view('committeedetails::committee_details');
    }

    /**
     * Show the admin page for committee details.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showAdminPage()
    {
        $this->authorize('committeedetails.view-admin');

        return view('committeedetails::admin');
    }

    /*
    |--------------------------------------------------------------------------
    | Control Committee Members
    |--------------------------------------------------------------------------
    |
    | Create, update and delete committee members from the control database.
    |
    */

    /**
     * Add a new committee member to the control database, as part of the committee
     *
     * @param Request $request
     * @return \ActiveResource\Model|bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function addUserToControl(Request $request)
    {
        $this->authorize('committeedetails.add-committee-member');
        // Validate the request
        $this->validateRequest($request);

        // Create a new committee role, populate and save it
        $committeeRole = $this->updateCommitteeRole($request, new CommitteeRole());
        if($committeeRole !== false) {
            Event::dispatch('committeedetails.added', $committeeRole);
        }

    }

    /**
     * Update a committee member in the control database. This method is used when a current position is being
     * edited.
     *
     * @param Request $request
     * @param $positionStudentGroupID
     * @return \ActiveResource\Model|bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateUserInControl(Request $request, $positionStudentGroupID)
    {
        $this->authorize('committeedetails.update-committee-member');

        // Validate the request
        $this->validateRequest($request, (int) $positionStudentGroupID);

        // Find and check the committee role that needs editing
        $committeeRole = CommitteeRole::find($positionStudentGroupID);
        abort_if($committeeRole === false, 404, 'Couldn\'t find your role ID');

        // Update and save the committee role
        return $this->updateCommitteeRole($request, $committeeRole);
    }

    /**
     * Delete a committee member from the control database
     *
     * @param Request $request
     * @param $positionStudentGroupID
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteCommitteeRoleFromControl(Request $request, $positionStudentGroupID)
    {
        $this->authorize('committeedetails.delete-committee-member');

        $positionStudentGroup = CommitteeRole::find($positionStudentGroupID);

        abort_if($positionStudentGroup === false, 404, 'Couldn\'t find the committee role');
        abort_if(!$positionStudentGroup->destroy(), 500, 'Couldn\'t delete the committee role');

        return response('', 200);
    }


    /*
     |--------------------------------------------------------------------------
     | Helpers
     |--------------------------------------------------------------------------
     |
     | Functions to help the above
     |
     */


    /**
     * Get all the possible positions for a group
     *
     * @return array
     */
    public function getPositions()
    {
        $positions = Position::all();
        $positionSettings = PositionSetting::where('tag_reference', getGroupType())->first();
        $group = Group::find(
            getGroupID()
        );
        $committeeRoles = CommitteeRole::allThrough($group);

        if ($positionSettings === false) {
            return back()
                ->withErrors(['position_id' => 'Could not find your group type']);
        }


        $filteredPositions = $positions->filter(function($position) use ($positionSettings, $group, $committeeRoles) {
            // TODO Make this use the rules which committee roles use

            // Ensure the position is allowed
            if (!in_array($position->id, $positionSettings->allowed_positions)) {
                return false;
            }
            // Ensure the position isn't taken
            if (in_array($position->id, $positionSettings->position_only_has_single_committee_member)) {
                if ($committeeRoles->filter(function($committeeRole) use ($position) {
                    return $committeeRole->position_id === $position->id
                        && $committeeRole->committee_year === config('portal.reaffiliation_year');
                })->count() > 0) {
                    return false;
                }
            }
            return true;
        })->values();

        return $filteredPositions;
    }

    /**
     * Validate a request
     *
     * @param Request $request
     * @param int|null $ignoreCommitteeRoleID Committee Role to ignore through validation
     * @throws \Exception
     */
    private function validateRequest(Request $request, $ignoreCommitteeRoleID = null)
    {

        $request->validate([
            'unioncloud_id' => ['required', new UnionCloudUIDExists()],
            'position_id' => ['required', new PositionIsAllowed(), new PositionMustBeEmpty($ignoreCommitteeRoleID), new IsStudentAvailable($ignoreCommitteeRoleID)],
            'position_name' => 'sometimes|string|min:3|max:255'
        ]);

    }

    /**
     * Parse the request and save the committee role, having updated it with data from the request.
     *    * @param Request $request
     * @param CommitteeRole $committeeRole
     * @return \ActiveResource\Model|bool
     */

    private function updateCommitteeRole(Request $request, CommitteeRole $committeeRole)
    {
        // Validate Request
        $committeeRole->student_id = $this->getStudentControlID($request->get('unioncloud_id'));
        $committeeRole->group_id = getGroupID();
        $committeeRole->position_id = $request->get('position_id');
        $committeeRole->position_name = $request->get('position_name');

        if (!$committeeRole->save()) {
            Log::error('Could not save committee role. Code '.$committeeRole->getResponse()->getStatusCode().', Message '.$committeeRole->getResponse()->getStatusPhrase());
            abort(500, 'We could not save your new committee position');
        }

        return CommitteeRole::find($committeeRole->id);
    }







}
