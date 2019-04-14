<?php

namespace App\Modules\RiskAssessment\Providers;

use App\Modules\RiskAssessment\Entities\File;
use App\Packages\FileUpload\DocumentStatusChangedApproved;
use App\Packages\FileUpload\DocumentStatusChangedRejected;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    public function boot() {

        Event::listen('riskassessment.fileStatusChanged.approved', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedApproved($file, 'Risk Assessment'));
        });

        Event::listen('riskassessment.fileStatusChanged.rejected', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChangedRejected($file, 'Risk Assessment'));
        });

        Event::listen('riskassessment.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Risk Assessment Uploaded'));
        });

    }
}
