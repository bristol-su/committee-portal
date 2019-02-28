<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use ActiveResource\ConnectionManager;
use App\Http\Controllers\Controller;
use App\Modules\CommitteeDetails\Entities\PositionSetting;
use App\Modules\CommitteeDetails\Http\Middleware\LoadGroupPositionRequirementsIntoJavascript;
use App\Modules\CommitteeDetails\Http\Requests\CommitteeMemberRequest;
use App\Modules\CommitteeDetails\Rules\PositionIsAllowed;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
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
     * @param Request $request
     * @param $positionStudentGroupID
     * @return CommitteeRole
     */
    public function updateUserInControl(Request $request, $positionStudentGroupID)
    {
        // Validate the request
        $this->validateUserAdditionRequest($request);

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

        if (!$positionStudentGroup->destroy()) {
            Log::error($positionStudentGroup->getResponse()->getStatusCode() . ' - ' . $positionStudentGroup->getResponse()->getStatusPhrase());
            abort(500, 'Couldn\'t delete the committee role');
        }
        return response('', 200);
    }

    /**
     * Validate the Student and Position details
     *
     * @param Request $request
     */
    private function validateUserAdditionRequest(Request $request)
    {
        $groupId = Auth::guard('committee-role')->user()->group->id;
        $group = Group::find($groupId);

        $request->validate([
            'unioncloud_id' => ['required', new UnionCloudUIDExists],
            'position_id' => ['required', new PositionIsAllowed],
            'position_name' => 'sometimes|string|min:3|max:255'
        ]);

        $positionId = $request->get('position_id');

        $positionSettings = PositionSetting::where('tag_reference', getTagReference())->get()->first();

        // Only allowed single committee member
        if(in_array($request->get('position_id'), $positionSettings->position_only_has_single_committee_member)) {
            // Error if anyone else currently holds this position
            if (CommitteeRole::allThrough($group)->filter(function($committeeRole) use ($positionId) {
                return $committeeRole->position_id === $positionId;
            })->count() === 0) {
                abort(422, 'Someone else already has that position.');
            }
        }

        // Not allowed any other position
        if(in_array($request->get('position_id'), $positionSettings->committee_member_only_has_single_position)) {
            // If this student holds any other position, error
        }
    }

    /**
     * Fill data from the committee form and save a committee role
     *
     * @param Request $request
     * @param CommitteeRole $committeeRole
     * @return CommitteeRole
     */
    private function updateCommitteeRole(Request $request, CommitteeRole $committeeRole)
    {
        // Validate Request
        $committeeRole->student_id = $this->getStudentControlID($request->get('unioncloud_id'));
        $committeeRole->group_id = Auth::guard('committee-role')->user()->group->id;
        $committeeRole->position_id = $request->get('position_id');
        $committeeRole->position_name = $request->get('position_name');

        if (!$committeeRole->save()) {
            Log::error('Could not save committee role. Code ' . $committeeRole->getResponse()->getStatusCode() . ', Message ' . $committeeRole->getResponse()->getStatusPhrase());
            abort(500, 'We could not save your new committee position');
        }
        return $committeeRole;
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
