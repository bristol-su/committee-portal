<?php

namespace App\Modules\StrategicPlan\Listeners;

use App\Packages\FileUpload\DocumentStatusChanged;
use App\Modules\StrategicPlan\Entities\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyUserOfStrategicPlanFileStatusChange implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  File $file
     * @return void
     */
    public function handle($file)
    {
        Mail::to($file->user->email)->send(new DocumentStatusChanged($file, 'Strategic Plan Status Updated'));
    }
}
