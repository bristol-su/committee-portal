<?php

namespace App\Modules\PresidentHandover\Providers;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    public function boot() {
        Event::listen('presidenthandover.submitted', function(CommitteeRole $committeeRole) {
            // Notify incoming president (google)
            // Notify old president to confirm handover
        });

    }
}
