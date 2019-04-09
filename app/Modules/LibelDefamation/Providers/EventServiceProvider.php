<?php


namespace App\Modules\LibelDefamation\Providers;

use App\Modules\LibelDefamation\Entities\Submission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {

         Event::listen('libeldefamation.submitted', function(Submission $submission) {
            // Notify submitter it was received
         });
    }
}