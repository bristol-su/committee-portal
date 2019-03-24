<?php

namespace App\Modules\GroupInfo\Listeners;

use App\Modules\GroupInfo\Entities\Submission;
use App\Modules\GroupInfo\Events\GroupInformationUpdated;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogGroupDataSubmission implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels;

    /**
     * @param GroupInformationUpdated $event
     * @throws \Exception
     */
    public function handle(GroupInformationUpdated $event)
    {
        $this->createSubmission($event->user, $event->group);
    }

    protected function createSubmission($user, $group)
    {
        $submission = new Submission();
        $submission->user_id = $user->id;
        $submission->group_id = $group->id;
        $submission->year = getReaffiliationYear();

        if(!$submission->save()) {
            throw new \Exception('Could not save your group', 500);
        }
    }
}
