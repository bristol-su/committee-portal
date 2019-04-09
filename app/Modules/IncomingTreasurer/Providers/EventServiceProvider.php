<?php


namespace App\Modules\IncomingTreasurer\Providers;

use App\Modules\IncomingTreasurer\Entities\Submission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {

         Event::listen('incomingtreasurer.training_completed', function(Submission $submission) {
            // Notify incoming treasurer the training was marked as completed
         });
    }
}