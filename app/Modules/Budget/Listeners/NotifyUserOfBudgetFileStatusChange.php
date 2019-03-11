<?php

namespace App\Modules\Budget\Listeners;

use App\Mail\DefaultDocumentStatusChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyUserOfBudgetFileStatusChange implements ShouldQueue
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
        Mail::to($file->user->email)->send(new DefaultDocumentStatusChanged($file, 'Budget Status Updated'));
    }
}
