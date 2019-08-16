<?php

namespace App\Providers;

use App\Events\UserVerificationRequestGenerated;
use App\Support\Completion\EventStoreListener;
use App\Support\Completion\Contracts\StoreEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        StoreEvent::class => [
            EventStoreListener::class
        ]
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
