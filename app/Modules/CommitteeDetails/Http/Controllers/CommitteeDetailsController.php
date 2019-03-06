<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use ActiveResource\ConnectionManager;
use App\Http\Controllers\Controller;
use App\Modules\CommitteeDetails\Entities\PositionSetting;
use App\Modules\CommitteeDetails\Http\Middleware\LoadGroupPositionRequirementsIntoJavascript;
use App\Modules\CommitteeDetails\Http\Requests\CommitteeMemberRequest;
use App\Modules\CommitteeDetails\Rules\PositionIsAllowed;
use App\Modules\CommitteeDetails\Rules\PositionMustBeEmpty;
use App\Modules\CommitteeDetails\Rules\IsStudentAvailable;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use App\Rules\IsCorrectPositionId;
use App\Rules\IsCorrectUnionCloudUid;
use App\Rules\UnionCloudUIDExists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommitteeDetailsController extends Controller
{

    public function __construct()
    {
        $this->middleware(LoadGroupPositionRequirementsIntoJavascript::class)->only('showUserForm');
    }

    /**
     * Show the main user edit form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUserForm()
    {
        return view('committeedetails::committee_details');
    }

    /**
     * Add a new committee role to Control
     *
     * @param Request $request
     * @return CommitteeRole
     *
     * @throws \Exception
     */
    public function addUserToControl(Request $request)
    {
        // Validate the request
        $this->validateUserAdditionRequest($request);

        // Create a new committee role, populate and save it
        return $this->updateCommitteeRole($request, new CommitteeRole());

    }

    /**
     * Edit a committee role in control
     *
     * @param Request $request
     * @param $positionStudentGroupID
     * @return CommitteeRole
     *
     * @throws \Exception
     */
    public function updateUserInControl(Request $request, $positionStudentGroupID)
    {
        // Validate the request
        $this->validateUserAdditionRequest($request, (int) $positionStudentGroupID);

        // Find and check the committee role that needs editing
        $committeeRole = CommitteeRole::find($positionStudentGroupID);
        abort_if($committeeRole === false, 404, 'Couldn\'t find your role ID');

        // Update and save the committee role
        return $this->updateCommitteeRole($request, $committeeRole);
    }

    /**
     * Delete committee role from control
     *
     * @param Request $request
     * @param $positionStudentGroupID
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteCommitteeRoleFromControl(Request $request, $positionStudentGroupID)
    {
        $positionStudentGroup = CommitteeRole::find($positionStudentGroupID);

        abort_if($positionStudentGroup === false, 404, 'Couldn\'t find the committee role');
        abort_if(!$positionStudentGroup->destroy(), 500, 'Couldn\'t delete the committee role');

        return response('', 200);
    }

    /**
     * Get available positions for a group
     *
     * @return array
     */
    public function getPositions()
    {
        $positions = Position::all();
        $positionSettings = PositionSetting::where('tag_reference', getGroupType())->get()->first();
        $group = Group::find(
            Auth::user()->getAuthenticatedUser()->group->id
        );
        $committeeRoles = CommitteeRole::allThrough($group);

        if($positionSettings === false) {
            return back()
                ->withErrors(['position_id' => 'Could not find your group type']);
        }


        $filteredPositions = $positions->filter(function($position) use ($positionSettings, $group, $committeeRoles) {
            // TODO Make this use the rules which committee roles use

            // Ensure the position is allowed
            if( !in_array($position->id, $positionSettings->allowed_positions)) {
                return false;
            }
            // Ensure the position isn't taken
            if(in_array($position->id, $positionSettings->position_only_has_single_committee_member)) {
                if($committeeRoles->filter(function($committeeRole) use ($position) {
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
     * Validate the Student and Position details
     *
     * @param Request $request
     * @param int|null $ignoreCommitteeRoleID ID of a committee role to ignore for rules
     *
     * @throws \Exception
     */
    private function validateUserAdditionRequest(Request $request, $ignoreCommitteeRoleID=null)
    {

        $request->validate([
            'unioncloud_id' => ['required', new UnionCloudUIDExists()],
            'position_id' => ['required', new PositionIsAllowed(), new PositionMustBeEmpty($ignoreCommitteeRoleID), new IsStudentAvailable($ignoreCommitteeRoleID)],
            'position_name' => 'sometimes|string|min:3|max:255'
        ]);

    }

    /**
     * Fill data from the committee form and save a committee role
     *
     * @param Request $request
     * @param CommitteeRole $committeeRole
     * @return \ActiveResource\Model|bool
     */
    private function updateCommitteeRole(Request $request, CommitteeRole $committeeRole)
    {
        // Validate Request
        $committeeRole->student_id = $this->getStudentControlID($request->get('unioncloud_id'));
        $committeeRole->group_id = Auth::user()->getAuthenticatedUser()->group->id;
        $committeeRole->position_id = $request->get('position_id');
        $committeeRole->position_name = $request->get('position_name');

        if (!$committeeRole->save()) {
            Log::error('Could not save committee role. Code ' . $committeeRole->getResponse()->getStatusCode() . ', Message ' . $committeeRole->getResponse()->getStatusPhrase());
            abort(500, 'We could not save your new committee position');
        }

        return CommitteeRole::find($committeeRole->id);
    }

    /**
     * Get the Control ID of a student by their UnionCloud ID
     *
     * @param $uid
     * @return mixed|null
     */
    private function getStudentControlID($uid)
    {
        // Search for a student by Student ID

        // Create an empty student model
        $student = new Student();

        // Send request
        $connection = ConnectionManager::get('control');
        $request = $connection->buildRequest('post', 'students/search', ['uc_uid' => $uid]);
        $response = $connection->send($request);

        // Parse the response by hydrating the model
        if ($response->isSuccessful()) {
            $student->hydrate($response->getPayload()[0]);
        } else {
            $student->uc_uid = $uid;
            abort_if(!$student->save(), 500, 'We couldn\'t save you in our system.');
        }

        return $student->id;
    }





}
