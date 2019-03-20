<?php

namespace App\Modules\Constitution\Providers;

use App\Modules\Constitution\Listeners\NotifyUserOfConstitutionFileStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'constitution.fileStatusChanged' => [
            NotifyUserOfConstitutionFileStatusChange::class
        ]
    ];
}
