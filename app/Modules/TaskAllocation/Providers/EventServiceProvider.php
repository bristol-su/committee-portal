<?php


namespace App\Modules\TaskAllocation\Providers;

use App\Modules\TaskAllocation\Entities\Submission;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    public function boot() {
        Event::listen('taskallocation.submitted', function(Submission $submission) {
            // Notify submitter it was received
            // If responsible for equipment list, mail
            // If responsible for risk assessment, mail
            // If responsible for constitution, mail
            // Otherwise, generic mail? Or
        });

    }
}
