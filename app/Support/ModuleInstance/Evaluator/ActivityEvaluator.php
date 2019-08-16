<?php


namespace App\Support\ModuleInstance\Evaluator;


use App\Support\Activity\Activity;
use App\Support\ModuleInstance\Contracts\Evaluator\ActivityEvaluator as ActivityEvaluatorContract;
use App\Support\ModuleInstance\Contracts\Evaluator\ModuleInstanceEvaluator as ModuleInstanceEvaluatorContract;

class ActivityEvaluator implements ActivityEvaluatorContract
{

    /**
     * @var ModuleInstanceEvaluatorContract
     */
    private $moduleInstanceEvaluator;

    public function __construct(ModuleInstanceEvaluatorContract $moduleInstanceEvaluator)
    {
        $this->moduleInstanceEvaluator = $moduleInstanceEvaluator;
    }

    public function evaluateAdministrator(Activity $activity){
        $evaluated = [];
        foreach($activity->moduleInstances as $moduleInstance) {
            $evaluated[$moduleInstance->id] = clone $this->moduleInstanceEvaluator->evaluateAdministrator($moduleInstance);
        }
        return $evaluated;
    }

    public function evaluateParticipant(Activity $activity) {
        $evaluated = [];
        foreach($activity->moduleInstances as $moduleInstance) {
            $evaluated[$moduleInstance->id] = clone $this->moduleInstanceEvaluator->evaluateParticipant($moduleInstance);
        }
        return $evaluated;
    }

}
