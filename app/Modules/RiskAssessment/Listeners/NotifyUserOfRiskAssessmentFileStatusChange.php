<?php

namespace App\Modules\RiskAssessment\Listeners;

use App\Mail\DefaultDocumentStatusChanged;
use App\Modules\RiskAssessment\Entities\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOfRiskAssessmentFileStatusChange implements ShouldQueue
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
        Mail::to($file->user->email)->send(new DefaultDocumentStatusChanged($file, 'Risk Assessment Status Updated'));
    }
}
