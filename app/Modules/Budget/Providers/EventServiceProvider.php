<?php

namespace App\Modules\Budget\Providers;

use App\Modules\Budget\Entities\File;
use App\Packages\FileUpload\DocumentStatusChangedApproved;
use App\Packages\FileUpload\DocumentStatusChangedRejected;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{


    public function boot()
    {
        Event::listen('budget.fileStatusChanged.approved', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedApproved($file, 'Annual Budget'));
        });

        Event::listen('budget.fileStatusChanged.rejected', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedRejected($file, 'Annual Budget'));
        });

        Event::listen('budget.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Annual Budget Uploaded'));
        });
    }
}
