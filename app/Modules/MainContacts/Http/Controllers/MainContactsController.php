<?php

namespace App\Modules\MainContacts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MainContacts\Entities\Contact;
use App\Modules\MainContacts\Entities\Submission;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Student;
use App\Rules\IsValidControlID;
use App\Traits\CanTagGroups;
use App\Traits\FindsUnionCloudUserByRoleName;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MainContactsController extends Controller
{

    use FindsUnionCloudUserByRoleName, CanTagGroups {
        CanTagGroups::groupHasTag insteadof FindsUnionCloudUserByRoleName;
        CanTagGroups::getTagFromGroup insteadof FindsUnionCloudUserByRoleName;
    }

    public function showPage() {

        $this->authorize('maincontacts.view');

        return view('maincontacts::maincontacts');
    }

    public function showAdminPage() {

        $this->authorize('maincontacts.view-admin');

        return view('maincontacts::admin');
    }

    public function updateContacts(Request $request) {

        $this->authorize('maincontacts.submit');

        $contacts = Contact::all();

        // Validate the request
        $validationRules = [];

        // Iterate through each of the given subjects
        $contacts->each(function($contact) use (&$validationRules){
            if($contact->required) {
                $validationRules['id_'.$contact->id] = ['required', new IsValidControlID()];
            } else {
                $validationRules['id_'.$contact->id] = ['sometimes', new IsValidControlID()];
            }
        });

        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Get some details
        $group = Auth::user()->getCurrentRole()->group;
        $presidentRole = $this->roles($group)->filter(function($role) {
            return $this->studentHasPresidentialPosition($role) && $this->studentIsNewCommittee($role);
        })->first();
        abort_if(!$presidentRole, 404, 'Could not find your groups president');
        $president = $presidentRole->student;

        // Update each contact in the control database
        $contacts->each(function(Contact $contact) use ($request, $group, $president) {
            // Get the student to tag && tag the groups interest
            if($request->input('id_'.$contact->id) !== null) {
                $student = Student::find($request->input('id_'.$contact->id));
                $this->addOrUpdateTag($group, 'notifications_interest', $contact->tag_reference);
            } else {
                $student = $president;
                $this->removeTagIfOwned($group, 'notifications_interest', $contact->tag_reference);
            }

            // Tag the student as the main contact
            $contact->updateInControl($student, $group);
        });

        $filteredContacts = $contacts->filter(function(Contact $contact) use ($request) {
            return $request->input('id_'.$contact->id) !== null;
        });
        $groupedContacts = $filteredContacts->groupBy(function($contact) use ($request, $president) {
            return $request->input('id_'.$contact->id, $president->id);
        });

        $committee = CommitteeRole::allThrough(Group::find(Auth::user()->getCurrentRole()->group->id));

        foreach($groupedContacts as $studentId => $studentContacts) {
            $committeeRole = $committee->filter(function($committee) use ($studentId) {
                return $committee->student->id === $studentId;
            })->first();
            Event::dispatch('maincontacts.responsible', [$committeeRole, $studentContacts]);
        }

        if($submission = Submission::create([
            'user_id' => Auth::user()->id,
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'year' => getReaffiliationYear()
        ])) {
            Event::dispatch('maincontacts.submitted', $submission);
        }

    }

    public function getContacts(Request $request)
    {
        $this->authorize('maincontacts.view');

        $contacts = Contact::all();
        $group = Auth::user()->getCurrentRole()->group;

        return $contacts->map(function(Contact $contact) use ($group) {
            // If contact is required or group is interested
            if($contact->required || $this->groupHasTag($group, 'notifications_interest', $contact->tag_reference)) {
                $contact->answer = $contact->answer($group);
            } else {
                $contact->answer = null;
            }
            return $contact->toArray();

        });
    }

    public function getCommittee(Request $request)
    {
        $this->authorize('maincontacts.view');

        return Contact::all();
    }

}
