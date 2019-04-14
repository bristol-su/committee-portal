<?php


namespace App\Modules\EquipmentList\Providers;

use App\Modules\EquipmentList\Emails\NotifySubmitterOnEquipmentListSubmitted;
use App\Modules\EquipmentList\Entities\Submission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {
         Event::listen('equipmentlist.submitted', function(Submission $submission) {
             Mail::to($submission->user->email)->send(new NotifySubmitterOnEquipmentListSubmitted($submission));
         });
    }

}