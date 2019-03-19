<?php

namespace App\Modules\ExecutiveSummary\Providers;

use App\Modules\ExecutiveSummary\Listeners\NotifyUserOfExecutiveSummaryFileStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'executivesummary.fileStatusChanged' => [
            NotifyUserOfExecutiveSummaryFileStatusChange::class
        ]
    ];
}
