<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ActivityInstance\ActivityInstance;
use BristolSU\Support\ActivityInstance\Contracts\ActivityInstanceRepository;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\ModuleInstance\Contracts\Evaluator\ActivityInstanceEvaluator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use BristolSU\Support\Authentication\Contracts\ResourceIdGenerator;

class ActivityController extends Controller
{

    public function administrator(Activity $activity, ActivityInstance $activityInstance, Authentication $authentication)
    {
        $resourceType = $activity->activity_for;
        $resourceId = app(ResourceIdGenerator::class)->fromString($resourceType);

        return view('portal.activity')->with([
            'activity' => $activity->load('moduleInstances'),
            'activityInstance' => $activityInstance,
            'activityInstances' => app(ActivityInstanceRepository::class)->allFor($activity->id, $resourceType, $resourceId),
            'admin' => true,
            'evaluation' => collect(app(ActivityInstanceEvaluator::class)->evaluateAdministrator($activityInstance, $authentication->getUser(), $authentication->getGroup(), $authentication->getRole()))
        ]);
    }

    public function participant(Activity $activity, ActivityInstance $activityInstance, Authentication $authentication)
    {
        $resourceType = $activity->activity_for;
        $resourceId = app(ResourceIdGenerator::class)->fromString($resourceType);

        return view('portal.activity')->with([
            'activity' => $activity->load('moduleInstances'),
            'activityInstance' => $activityInstance,
            'activityInstances' => app(ActivityInstanceRepository::class)->allFor($activity->id, $resourceType, $resourceId),
            'admin' => false,
            'evaluation' => collect(app(ActivityInstanceEvaluator::class)->evaluateParticipant($activityInstance, $authentication->getUser(), $authentication->getGroup(), $authentication->getRole()))
        ]);
    }

}
