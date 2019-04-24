<?php


namespace App\Modules\GDPR\Providers;

use App\Modules\GDPR\Emails\NotifySubmitterOnSubmission;
use App\Modules\GDPR\Entities\Submission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {

        Event::listen('gdpr.submitted', function(Submission $submission) {
            Mail::to($submission->user->email)->send(new NotifySubmitterOnSubmission($submission));
        });
    }
}