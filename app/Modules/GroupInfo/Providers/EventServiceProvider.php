<?php

namespace App\Modules\GroupInfo\Providers;


use App\Modules\GroupInfo\Entities\Submission;
use App\Modules\GroupInfo\Events\GroupInformationUpdated;
use App\Modules\GroupInfo\Listeners\LogGroupDataSubmission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
   protected $listen = [
       GroupInformationUpdated::class => [
           LogGroupDataSubmission::class,
       ]
   ];

   public function boot()
   {
       Event::listen(GroupInformationUpdated::class, function(Submission $submission) {
            // Notify submitter that the submission worked.
       });
   }
}
