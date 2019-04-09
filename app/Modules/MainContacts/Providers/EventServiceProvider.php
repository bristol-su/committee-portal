<?php

namespace App\Modules\MainContacts\Providers;

use App\Modules\MainContacts\Entities\Submission;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {

        Event::listen('maincontacts.submitted', function(Submission $submission) {
            // Email what responsible for
            // Notify submitter it was received
        });
    }
}