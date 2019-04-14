<?php


namespace App\Modules\PoliticalActivity\Providers;

use App\Modules\PoliticalActivity\Emails\NotifySubmitterOnSubmission;
use App\Modules\PoliticalActivity\Entities\Submission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {

         Event::listen('politicalactivity.submitted', function(Submission $submission) {
            Mail::to($submission->user->email)->send(new NotifySubmitterOnSubmission($submission));
         });
    }
}