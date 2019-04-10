<?php

namespace App\Modules\Constitution\Providers;

use App\Modules\Constitution\Entities\File;
use App\Modules\Constitution\Listeners\NotifyUserOfConstitutionFileStatusChange;
use App\Packages\FileUpload\DocumentStatusChanged;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen('constitution.fileStatusChanged', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChanged($file, 'Constitution Status Updated'));
        });

        Event::listen('constitution.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Constitution Uploaded'));
        });
    }
}
