<?php


namespace App\Modules\CommitteeDetails\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    public function boot() {
        Event::listen('committeedetails.added', function() {
            // Send treasurer email from google
            // Send email to any new committee member
        });
    }
}