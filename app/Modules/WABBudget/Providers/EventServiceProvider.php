<?php

namespace App\Modules\WABBudget\Providers;

use App\Modules\WABBudget\Entities\File;
use App\Packages\FileUpload\DocumentStatusChangedApproved;
use App\Packages\FileUpload\DocumentStatusChangedRejected;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    public function boot() {
        Event::listen('wabbudget.fileStatusChanged.approved', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedApproved($file, '#WeAreBristol Budget'));
        });

        Event::listen('wabbudget.fileStatusChanged.rejected', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedRejected($file, '#WeAreBristol Budget'));
        });

        Event::listen('wabbudget.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, '#WeAreBristolBudget Uploaded'));
        });
    }
}
