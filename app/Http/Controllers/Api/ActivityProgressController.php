<?php


namespace App\Http\Controllers\Api;


use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ActivityInstance\ActivityInstance;
use BristolSU\Support\ActivityInstance\Contracts\ActivityInstanceRepository;
use BristolSU\Support\ActivityInstance\Contracts\DefaultActivityInstanceGenerator;
use BristolSU\Support\Logic\Contracts\Audience\LogicAudience;
use BristolSU\Support\ModuleInstance\Facade\ModuleInstanceEvaluator;

class ActivityProgressController
{

    public function show(Activity $activity, ActivityInstanceRepository $activityInstanceRepository, DefaultActivityInstanceGenerator $defaultActivityInstanceGenerator)
    {
        $activityInstances = $activityInstanceRepository->allForActivity($activity->id)->map(function(ActivityInstance $activityInstance) {
            $activityInstance->load('moduleInstances');
            $activityInstance->moduleInstances->map(function($moduleInstance) use ($activityInstance) {
                $moduleInstance->evaluation = ModuleInstanceEvaluator::evaluateParticipant($activityInstance, $moduleInstance)->toArray();
                return $moduleInstance;
            });
            return $activityInstance;
        });

        $participantsWithActivityInstances = collect($activityInstances)->pluck('resource_id')->unique()->values();

        $audience = $this->getAudience($activity);
        $audience = $audience->filter(function($participant) use ($participantsWithActivityInstances) {
            return !in_array($participant->id(), $participantsWithActivityInstances->toArray());
        });
        foreach($audience as $participant) {
            $activityInstances[] = $defaultActivityInstanceGenerator->generate($activity, $activity->activity_for, $participant->id());
        }
        return $activityInstances;
    }

    private function getAudience(Activity $activity)
    {
        $logicAudience = app(LogicAudience::class);
        if($activity->activity_for === 'user') {
            return $logicAudience->userAudience($activity->forLogic);
        } elseif($activity->activity_for === 'group') {
            return $logicAudience->groupAudience($activity->forLogic);
        } elseif($activity->activity_for === 'role') {
            return $logicAudience->roleAudience($activity->forLogic);
        }
        throw new \Exception('Activity for must be one of user, group or role');
    }

}
