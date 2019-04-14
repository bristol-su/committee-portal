<?php

namespace App\Modules\TaskAllocation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TaskAllocation\Entities\Submission;
use App\Modules\TaskAllocation\Entities\Task;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Student;
use App\Rules\IsValidControlID;
use App\Traits\CanTagStudents;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TaskAllocationController extends Controller
{


    public function showPage() {

        $this->authorize('taskallocation.view');

        return view('taskallocation::taskallocation');
    }

    public function showAdminPage() {

        $this->authorize('taskallocation.view-admin');

        return view('taskallocation::admin');
    }

    public function updateTasks(Request $request) {

        $this->authorize('taskallocation.submit');

        $tasks = Task::all();

        // Validate the request
        $validationRules = [];
        $tasks->each(function($task) use (&$validationRules){
            $validationRules['id_'.$task->id] = ['required', new IsValidControlID()];
        });
        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Update each task in the control database
        $tasks->each(function(Task $task) use ($request) {
            $student = Student::find($request->input('id_'.$task->id));
            $group = Auth::user()->getCurrentRole()->group;
            $task->updateInControl($student, $group);
        });

        $groupedTasks = $tasks->groupBy(function($task) use ($request) {
            return $request->input('id_'.$task->id);
        });

        $committee = CommitteeRole::allThrough(Group::find(Auth::user()->getCurrentRole()->group->id));

        foreach($groupedTasks as $studentId => $tasks) {
            $committeeRole = $committee->filter(function($committee) use ($studentId) {
                return $committee->student->id === $studentId;
            })->first();
            Event::dispatch('taskallocation.responsible', [$committeeRole, $tasks]);
        }
        if($submission = Submission::create([
            'user_id' => Auth::user()->id,
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'year' => getReaffiliationYear()
        ])) {
            Event::dispatch('taskallocation.submitted', $submission);
        }

    }

    public function getTasks(Request $request)
    {
        $this->authorize('taskallocation.view');

        $tasks = Task::all();
        $group = Auth::user()->getCurrentRole()->group;

        return $tasks->map(function(Task $task) use ($group) {
            $task->answer = $task->answer($group);
            return $task->toArray();
        });
    }

    public function getCommittee(Request $request)
    {
        $this->authorize('taskallocation.view');

        return Task::all();
    }
}
