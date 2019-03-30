<?php

namespace App\Modules\ExitingTreasurer\Listeners;

use App\Modules\IncomingTreasurer\Entities\Submission;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyOutgoingTreasurerOfIncomingTreasurerTrainingComplete
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
    public function handle($group_id, $year)
    {
        // Find the old treasurer

        // TODO Send email to old treasurer with info
    }
}
