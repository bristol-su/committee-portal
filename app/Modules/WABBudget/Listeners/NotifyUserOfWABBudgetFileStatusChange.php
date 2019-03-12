<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/03/19
 * Time: 22:06
 */

namespace App\Modules\WABBudget\Listeners;


use App\Mail\DefaultDocumentStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOfWABBudgetFileStatusChange implements ShouldQueue
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
        Mail::to($file->user->email)->send(new DefaultDocumentStatusChanged($file, '#WeAreBristol Budget Status Updated'));
    }

}