<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ModuleInstance\Contracts\Evaluator\ActivityEvaluator as ActivityEvaluatorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ActivityController extends Controller
{

    public function administrator(Activity $activity, ActivityEvaluatorContract $activityEvaluator)
    {
        return view('portal.portalcontent')->with([
            'activity' => $activity,
            'admin' => true,
            'evaluation' => collect($activityEvaluator->evaluateAdministrator($activity))
        ]);
    }

    public function participant(Activity $activity, ActivityEvaluatorContract $activityEvaluator)
    {
        return view('portal.portalcontent')->with([
            'activity' => $activity,
            'admin' => false,
            'evaluation' => collect($activityEvaluator->evaluateParticipant($activity))
        ]);
    }

}
