<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/03/19
 * Time: 22:06
 */

namespace App\Modules\ExecutiveSummary\Listeners;


use App\Packages\FileUpload\DocumentStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOfExecutiveSummaryFileStatusChange implements ShouldQueue
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
     * @return void
     */
    public function handle($file)
    {
        Mail::to($file->user->email)->send(new DocumentStatusChanged($file, '#WeAreBristol Executive Summary Status Updated'));
    }

}