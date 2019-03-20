<?php

namespace App\Modules\RiskAssessment\Providers;

use App\Modules\RiskAssessment\Listeners\NotifyUserOfRiskAssessmentFileStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'riskassessment.fileStatusChanged' => [
            NotifyUserOfRiskAssessmentFileStatusChange::class
        ]
    ];
}
