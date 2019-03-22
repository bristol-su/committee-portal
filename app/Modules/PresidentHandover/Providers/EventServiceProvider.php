<?php

namespace App\Modules\PresidentHandover\Providers;

use App\Modules\Presentation\Listeners\NotifyUserOfPresentationFileStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
    ];
}
