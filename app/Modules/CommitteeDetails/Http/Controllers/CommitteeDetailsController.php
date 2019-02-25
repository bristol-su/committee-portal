<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use ActiveResource\ConnectionManager;
use App\Http\Controllers\Controller;
use App\Modules\CommitteeDetails\Http\Middleware\LoadGroupPositionRequirementsIntoJavascript;
use App\Modules\CommitteeDetails\Http\Requests\CommitteeMemberRequest;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommitteeDetailsController extends Controller
{

    public function __construct()
    {
        $this->middleware(LoadGroupPositionRequirementsIntoJavascript::class);
    }

    public function showUserForm()
    {
        return view('committeedetails::committee_details');
    }

    public function addUserToControl(Request $request)
    {
        // Validate the request
        $this->validateUserAdditionRequest($request);

        // Create a new committee role, populate and save it
        return $this->updateCommitteeRole($request, new CommitteeRole());

    }

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

    public function deleteCommitteeRoleFromControl(Request $request, $positionStudentGroupID)
    {
        $positionStudentGroup = CommitteeRole::find($positionStudentGroupID);

        abort_if($positionStudentGroup === false, 404, 'Couldn\'t find the committee role');

        if(!$positionStudentGroup->destroy())
        {
            Log::error($positionStudentGroup->getResponse()->getStatusCode().' - '.$positionStudentGroup->getResponse()->getStatusPhrase());
            abort(500,'Couldn\'t delete the committee role');
        }
        return response('', 200);
    }

    private function validateUserAdditionRequest(Request $request)
    {
        // TODO Implement validation
    }

    private function updateCommitteeRole(Request $request, CommitteeRole $committeeRole)
    {
        // Validate Request
        $committeeRole->student_id = $this->getStudentControlID($request->get('unioncloud_id'));
        $committeeRole->group_id = Auth::guard('committee-role')->user()->group->id;
        $committeeRole->position_id = $request->get('position_id');
        $committeeRole->position_name = $request->get('position_name');

        if(!$committeeRole->save()) {
            Log::error('Could not save committee role. Code '.$committeeRole->getResponse()->getStatusCode().', Message '.$committeeRole->getResponse()->getStatusPhrase());
            abort(500, 'We could not save your new committee position');
        }
        return $committeeRole;
    }

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
        if( $response->isSuccessful()) {
            $student->hydrate($response->getPayload()[0]);
        } else {
            $student->uc_uid = $uid;
            abort_if(!$student->save(), 500, 'We couldn\'t save you in our system.');
        }

        return $student->id;
    }

}
