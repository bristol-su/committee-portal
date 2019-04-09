<?php

namespace App\Modules\ExecutiveSummary\Providers;

use App\Modules\ExecutiveSummary\Entities\File;
use App\Modules\ExecutiveSummary\Listeners\NotifyUserOfExecutiveSummaryFileStatusChange;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'executivesummary.fileStatusChanged' => [
            NotifyUserOfExecutiveSummaryFileStatusChange::class
        ],
    ];

    public function boot() {
        Event::listen('executivesummary.fileUploaded', function(File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, '#WeAreBristol Executive Summary Uploaded'));
        });
    }
}
