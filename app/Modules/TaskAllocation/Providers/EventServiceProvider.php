<?php


namespace App\Modules\TaskAllocation\Providers;

use App\Modules\TaskAllocation\Emails\NotifyResponsibleOnSubmission;
use App\Modules\TaskAllocation\Emails\NotifySubmitterOnSubmission;
use App\Modules\TaskAllocation\Entities\Submission;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Traits\FindsUnionCloudUserByRoleName;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    use FindsUnionCloudUserByRoleName;

    public function boot() {
        Event::listen('taskallocation.submitted', function(Submission $submission) {
            Mail::to($submission->user->email)->send(new NotifySubmitterOnSubmission($submission));

            // Otherwise, generic mail? Or
        });

        Event::listen('taskallocation.responsible', function(CommitteeRole $committeeRole, $tasks) {
            $user = $this->getStudentByCommitteeRole($committeeRole);
            $group = Group::find($committeeRole->group_id);
            $newPresident = $this->newPresident($group);
            Mail::to($user->email)->send(new NotifyResponsibleOnSubmission($user, $group,  $newPresident, $tasks));
        });

    }
}
