<?php

namespace App\Modules\WABStrategicPlan\Providers;

use App\Modules\WABStrategicPlan\Entities\File;
use App\Modules\WABStrategicPlan\Listeners\NotifyUserOfWABStrategicPlanFileStatusChange;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'wabstrategicplan.fileStatusChanged' => [
            NotifyUserOfWABStrategicPlanFileStatusChange::class
        ]
    ];

    public function boot() {
        Event::listen('wabstrategicplan.fileUploaded', function(File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, '#WeAreBristol Strategic Plan Uploaded'));
        });
    }
}
