<?php

namespace App\Modules\WABBudget\Providers;

use App\Modules\WABBudget\Entities\File;
use App\Modules\WABBudget\Listeners\NotifyUserOfWABBudgetFileStatusChange;
use App\Packages\FileUpload\DocumentUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'wabbudget.fileStatusChanged' => [
            NotifyUserOfWABBudgetFileStatusChange::class
        ]
    ];

    public function boot() {
        Event::listen('wabbudget.fileUploaded', function(File $file) {
            Mail::to($file->user->email)->send(new DocumentUploaded($file, '#WeAreBristol Budget Uploaded'));
        });
    }
}
