<?php


namespace App\Http\Controllers\Api;


use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ActivityInstance\ActivityInstance;
use BristolSU\Support\ActivityInstance\Contracts\ActivityInstanceRepository;
use BristolSU\Support\ModuleInstance\Facade\ModuleInstanceEvaluator;

class ActivityProgressController
{

    public function show(Activity $activity, ActivityInstanceRepository $activityInstanceRepository)
    {
        return $activityInstanceRepository->allForActivity($activity->id)->map(function(ActivityInstance $activityInstance) {
            $activityInstance->load('moduleInstances');
            $activityInstance->moduleInstances->map(function($moduleInstance) use ($activityInstance) {
                $moduleInstance->evaluation = ModuleInstanceEvaluator::evaluateParticipant($activityInstance, $moduleInstance)->toArray();
                return $moduleInstance;
            });
            return $activityInstance;
        });
    }

}
