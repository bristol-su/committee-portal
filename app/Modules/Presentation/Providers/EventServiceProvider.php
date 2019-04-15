<?php

namespace App\Modules\Presentation\Providers;

use App\Modules\Presentation\Entities\File;
use App\Packages\FileUpload\DocumentStatusChangedApproved;
use App\Packages\FileUpload\DocumentStatusChangedRejected;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    public function boot() {

        Event::listen('presentation.fileStatusChanged.approved', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedApproved($file, '#WeAreBristol Presentation'));
        });

        Event::listen('presentation.fileStatusChanged.rejected', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedRejected($file, '#WeAreBristol Presentation'));
        });

        Event::listen('presentation.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, '#WeAreBristol Presentation Uploaded'));
        });
    }
}
