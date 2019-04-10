<?php

namespace App\Modules\Presentation\Providers;

use App\Modules\Presentation\Entities\File;
use App\Modules\Presentation\Listeners\NotifyUserOfPresentationFileStatusChange;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'presentation.fileStatusChanged' => [
            NotifyUserOfPresentationFileStatusChange::class
        ]
    ];

    public function boot() {
        Event::listen('presentation.fileUploaded', function(File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, '#WeAreBristol Presentation Uploaded'));
        });
    }
}
