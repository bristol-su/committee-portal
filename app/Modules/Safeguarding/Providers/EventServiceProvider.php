<?php


namespace App\Modules\Safeguarding\Providers;

use App\Modules\Safeguarding\Entities\Submission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Event::listen('safeguarding.submitted',function(Submission $submission) {
            // Notify submitter
        });
    }

}