<?php


namespace App\Support\ModuleInstance\Contracts\Evaluator;


use App\Support\Activity\Activity;

interface ActivityEvaluator
{

    public function evaluateAdministrator(Activity $activity);

    public function evaluateParticipant(Activity $activity);

}
