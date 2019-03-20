<?php

namespace App\Modules\StrategicPlan\Providers;

use App\Modules\StrategicPlan\Listeners\NotifyUserOfStrategicPlanFileStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'strategicplan.fileStatusChanged' => [
            NotifyUserOfStrategicPlanFileStatusChange::class
        ]
    ];
}
