<?php


namespace App\Modules\CharitableGiving\Providers;

use App\Modules\CharitableGiving\Emails\NotifySubmitterOnSubmission;
use App\Modules\CharitableGiving\Entities\Submission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Event::listen('charitablegiving.submitted', function(Submission $submission) {
            Mail::to($submission->user->email)->send(new NotifySubmitterOnSubmission($submission));
        });
    }
}