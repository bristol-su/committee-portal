<?php

namespace App\Modules\MainContacts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MainContacts\Entities\Contact;
use App\Modules\MainContacts\Entities\Submission;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Student;
use App\Rules\IsValidControlID;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MainContactsController extends Controller
{
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
        $contacts->each(function($contact) use (&$validationRules){
            $validationRules['id_'.$contact->id] = ['required', new IsValidControlID()];
        });
        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Update each contact in the control database
        $contacts->each(function(Contact $contact) use ($request) {
            $student = Student::find($request->input('id_'.$contact->id));
            $group = Auth::user()->getCurrentRole()->group;
            $contact->updateInControl($student, $group);
        });

        $groupedContacts = $contacts->groupBy(function($contact) use ($request) {
            return $request->input('id_'.$contact->id);
        });

        $committee = CommitteeRole::allThrough(Group::find(Auth::user()->getCurrentRole()->group->id));

        foreach($groupedContacts as $studentId => $contacts) {
            $committeeRole = $committee->filter(function($committee) use ($studentId) {
                return $committee->student->id === $studentId;
            })->first();
            Event::dispatch('maincontacts.responsible', [$committeeRole, $contacts]);
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
            $contact->answer = $contact->answer($group);
            return $contact->toArray();
        });
    }

    public function getCommittee(Request $request)
    {
        $this->authorize('maincontacts.view');

        return Contact::all();
    }

}
