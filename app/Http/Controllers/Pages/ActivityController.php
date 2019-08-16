<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Support\Activity\Activity;
use App\Support\ModuleInstance\Contracts\Evaluator\ActivityEvaluator as ActivityEvaluatorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ActivityController extends Controller
{

    public function administrator(Activity $activity, ActivityEvaluatorContract $activityEvaluator)
    {
        return view('portal.portalcontent')->with([
            'activity' => $activity,
            'admin' => true,
            'evaluation' => $activityEvaluator->evaluateAdministrator($activity)
        ]);
    }

    public function participant(Activity $activity, ActivityEvaluatorContract $activityEvaluator)
    {
        return view('portal.portalcontent')->with([
            'activity' => $activity,
            'admin' => false,
            'evaluation' => $activityEvaluator->evaluateParticipant($activity)
        ]);
    }

}
