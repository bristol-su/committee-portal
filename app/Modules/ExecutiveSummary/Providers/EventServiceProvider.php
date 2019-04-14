<?php

namespace App\Modules\ExecutiveSummary\Providers;

use App\Modules\ExecutiveSummary\Entities\File;
use App\Modules\ExecutiveSummary\Listeners\NotifyUserOfExecutiveSummaryFileStatusChange;
use App\Packages\FileUpload\DocumentStatusChangedApproved;
use App\Packages\FileUpload\DocumentStatusChangedRejected;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    public function boot() {

        Event::listen('executivesummary.fileStatusChanged.approved', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedApproved($file, 'Executive Summary'));
        });

        Event::listen('executivesummary.fileStatusChanged.rejected', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedRejected($file, 'Executive Summary'));
        });

        Event::listen('executivesummary.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Executive Summary Uploaded'));
        });
    }
}
