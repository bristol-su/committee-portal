<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ActivityInstance\ActivityInstance;
use BristolSU\Support\ActivityInstance\Contracts\ActivityInstanceRepository;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\ModuleInstance\Contracts\Evaluator\ActivityInstanceEvaluator as ActivityInstanceEvaluatorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ActivityController extends Controller
{

    public function administrator(Activity $activity, ActivityInstance $activityInstance, ActivityInstanceEvaluatorContract $activityEvaluator, ActivityInstanceRepository $activityInstanceRepository)
    {
        $resourceType = app(Activity::class)->activity_for;
        if($resourceType === 'user') {
            $resourceId = app(Authentication::class)->getUser()->id;
        }
        if($resourceType === 'group') {
            $resourceId = app(Authentication::class)->getGroup()->id;
        }
        if($resourceType === 'role') {
            $resourceId = app(Authentication::class)->getRole()->id;
        }
        return view('portal.activity')->with([
            'activity' => $activity->load('moduleInstances'),
            'activityInstance' => $activityInstance,
            'activityInstances' => $activityInstanceRepository->allFor($activity->id, $resourceType, $resourceId),
            'admin' => true,
            'evaluation' => collect($activityEvaluator->evaluateAdministrator($activityInstance))
        ]);
    }

    public function participant(Activity $activity, ActivityInstance $activityInstance, ActivityInstanceEvaluatorContract $activityEvaluator, ActivityInstanceRepository $activityInstanceRepository)
    {
        $resourceType = app(Activity::class)->activity_for;
        if($resourceType === 'user') {
            $resourceId = app(Authentication::class)->getUser()->id;
        }
        if($resourceType === 'group') {
            $resourceId = app(Authentication::class)->getGroup()->id;
        }
        if($resourceType === 'role') {
            $resourceId = app(Authentication::class)->getRole()->id;
        }
        return view('portal.activity')->with([
            'activity' => $activity->load('moduleInstances'),
            'activityInstance' => $activityInstance,
            'activityInstances' => $activityInstanceRepository->allFor($activity->id, $resourceType, $resourceId),
            'admin' => false,
            'evaluation' => collect($activityEvaluator->evaluateParticipant($activityInstance))
        ]);
    }

}
