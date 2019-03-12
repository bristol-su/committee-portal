<?php

namespace App\Modules\WABBudget\Providers;

use App\Modules\WABBudget\Listeners\NotifyUserOfWABBudgetFileStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'wabbudget.fileStatusChanged' => [
            NotifyUserOfWABBudgetFileStatusChange::class
        ]
    ];
}
