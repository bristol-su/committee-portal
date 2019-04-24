<?php

namespace App\Modules\StrategicPlan\Providers;

use App\Modules\StrategicPlan\Entities\File;
use App\Packages\FileUpload\DocumentStatusChangedApproved;
use App\Packages\FileUpload\DocumentStatusChangedRejected;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    public function boot() {

        Event::listen('strategicplan.fileStatusChanged.approved', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedApproved($file, 'Strategic Plan'));
        });

        Event::listen('strategicplan.fileStatusChanged.rejected', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedRejected($file, 'Strategic Plan'));
        });

        Event::listen('strategicplan.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Strategic Plan Uploaded'));
        });
    }
}
