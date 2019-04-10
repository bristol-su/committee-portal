<?php

namespace App\Modules\RiskAssessment\Providers;

use App\Modules\Budget\Entities\File;
use App\Modules\RiskAssessment\Listeners\NotifyUserOfRiskAssessmentFileStatusChange;
use App\Packages\FileUpload\DocumentStatusChanged;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    public function boot() {
        Event::listen('riskassessment.fileStatusChanged', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentStatusChanged($file, 'Risk Assessment Status Updated'));
        });

        Event::listen('riskassessment.fileUploaded', function (File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, 'Risk Assessment Uploaded'));
        });
    }
}
