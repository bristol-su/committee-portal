<?php

namespace App\Modules\GroupInfo\Providers;


use App\Modules\GroupInfo\Emails\NotifySubmitterWhenGroupInfoSubmitted;
use App\Modules\GroupInfo\Entities\Submission;
use App\Modules\GroupInfo\Events\GroupInformationUpdated;
use App\Modules\GroupInfo\Listeners\LogGroupDataSubmission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

   public function boot()
   {
       Event::listen('groupinfo.submitted', function(Submission $submission) {
            Mail::to($submission->user->email)->send(new NotifySubmitterWhenGroupInfoSubmitted($submission));
       });

   }
}
