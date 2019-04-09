<?php

namespace App\Modules\Budget\Providers;

use App\Modules\Budget\Entities\File;
use App\Packages\FileUpload\DocumentStatusChanged;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{


    public function boot()
    {
        Event::listen('budget.fileStatusChanged', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChanged($file, 'Annual Budget Status Updated'));
        });

        Event::listen('budget.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Annual Budget Uploaded'));
        });
    }
}
