<?php

namespace App\Modules\ExitingTreasurer\Listeners;

use App\Modules\ExitingTreasurer\Entities\Document;
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
    public function handle($group_id, $year)
    {
        $group = Group::find($group_id);
        $title = $group->name . ' Finance Summary Report '.$year.'/'.substr($year+1, 2, 2);
        Document::create([
            'year' => $year,
            'title' => $title,
            'uploaded' => false,
            'type' => 'income_expenditure',
            'group_id' => $group_id
        ]);
    }
}
