<?php


namespace App\Modules\IncomingTreasurer\Providers;

use App\Modules\IncomingTreasurer\Emails\NotifyIncomingTreasurerOnTrainingSubmission;
use App\Modules\IncomingTreasurer\Entities\Submission;
use App\Traits\FindsUnionCloudUserByRoleName;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{

    use FindsUnionCloudUserByRoleName;

    public function boot()
    {

         Event::listen('incomingtreasurer.training_completed', function(Submission $submission) {
            $group = $submission->group();
            if($oldTreasurer = $this->oldTreasurer($group)) {
                Mail::to($this->newTreasurer($group))->send(new NotifyIncomingTreasurerOnTrainingSubmission($submission, $oldTreasurer));
            }
         });
    }
}