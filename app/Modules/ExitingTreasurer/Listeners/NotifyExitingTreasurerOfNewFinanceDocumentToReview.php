<?php

namespace App\Modules\ExitingTreasurer\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class NotifyExitingTreasurerOfNewFinanceDocumentToReview
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
     * @param  object  $event
     * @return void
     */
    public function handle($document)
    {
        Log::info($document);
        // TODO
    }
}
