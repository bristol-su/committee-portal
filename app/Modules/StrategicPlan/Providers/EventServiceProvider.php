<?php

namespace App\Modules\StrategicPlan\Providers;

use App\Modules\StrategicPlan\Entities\File;
use App\Modules\StrategicPlan\Listeners\NotifyUserOfStrategicPlanFileStatusChange;
use App\Packages\FileUpload\DocumentStatusChanged;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    public function boot() {
        Event::listen('strategicplan.fileStatusChanged', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChanged($file, 'Strategic Plan Status Updated'));
        });

        Event::listen('strategicplan.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Strategic Plan Uploaded'));
        });
    }
}
