<?php


namespace App\Modules\GDPR\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {

        // TODO Event::listen('gdpr.submitted', function())
    }
}