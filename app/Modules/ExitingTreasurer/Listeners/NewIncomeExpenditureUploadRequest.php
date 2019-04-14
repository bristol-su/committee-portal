<?php

namespace App\Modules\ExitingTreasurer\Listeners;

use App\Modules\ExitingTreasurer\Entities\Document;
use App\Modules\IncomingTreasurer\Entities\Submission;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewIncomeExpenditureUploadRequest
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
    public function handle(Submission $submission)
    {
        $group = $submission->group();
        $title = $group->name. ' Finance Summary Report '.$submission->year.'/'.substr($submission->year+1, 2, 2);
        Document::create([
            'year' => $submission->year,
            'title' => $title,
            'uploaded' => false,
            'type' => 'income_expenditure',
            'group_id' => $group->id
        ]);
    }
}
