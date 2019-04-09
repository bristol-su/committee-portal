<?php

namespace App\Modules\Constitution\Listeners;

use App\Packages\FileUpload\DocumentStatusChanged;
use App\Modules\Constitution\Entities\File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOfConstitutionFileStatusChange implements ShouldQueue
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
        Mail::to($file->user->email)->send(new DocumentStatusChanged($file, 'Constitution Status Updated'));
    }
}
