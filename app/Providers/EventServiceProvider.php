<?php

namespace App\Providers;

use App\Events\UserVerificationRequestGenerated;
use App\Mail\NotifyStudentServicesOnTreasurerOrPresidentAdded;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Traits\AuthorizesUsers;
use App\Traits\FindsUnionCloudUserByRoleName;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\LogEmailVerificationRequested;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserVerificationRequestGenerated::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
