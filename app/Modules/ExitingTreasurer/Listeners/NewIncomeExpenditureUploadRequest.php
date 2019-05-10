<?php

namespace App\Modules\ExitingTreasurer\Listeners;

use App\Modules\ExitingTreasurer\Entities\Document;
use App\Modules\IncomingTreasurer\Entities\Submission;
use App\Packages\ControlDB\Models\Account;
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
        $accounts = Account::allThrough($group);
        foreach($accounts as $account) {
            $title = $group->name. ' ('.$account->code.') Finance Summary Report '.($submission->year-1).'/'.substr($submission->year, 2, 2);
            Document::create([
                'year' => $submission->year,
                'title' => $title,
                'uploaded' => false,
                'type' => 'income_expenditure',
                'group_id' => $group->id
            ]);
        }
    }
}
