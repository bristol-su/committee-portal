<?php

namespace App\Modules\WABStrategicPlan\Providers;

use App\Modules\WABStrategicPlan\Listeners\NotifyUserOfWABStrategicPlanFileStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'wabstrategicplan.fileStatusChanged' => [
            NotifyUserOfWABStrategicPlanFileStatusChange::class
        ]
    ];
}
