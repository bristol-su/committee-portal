<?php


namespace App\Support\ModuleInstance\Evaluator;


use App\Support\Activity\Activity;
use App\Support\Completion\Facade\CompletionTester;
use App\Support\Logic\Facade\LogicTester;
use App\Support\ModuleInstance\Contracts\Evaluator\Evaluation as EvaluationContract;
use App\Support\ModuleInstance\Contracts\ModuleInstance;
use App\Support\ModuleInstance\Contracts\Evaluator\ModuleInstanceEvaluator as ModuleInstanceEvaluatorContract;

class ModuleInstanceEvaluator implements ModuleInstanceEvaluatorContract
{

    /**
     * @var EvaluationContract
     */
    private $evaluation;

    public function __construct(EvaluationContract $evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function evaluateAdministrator(ModuleInstance $moduleInstance)
    {
        $this->evaluation->setVisible(true);
        $this->evaluation->setMandatory(false);
        $this->evaluation->setActive(true);
        $this->evaluation->setComplete(false);

        return $this->evaluation;
    }

    public function evaluateParticipant(ModuleInstance $moduleInstance)
    {
        $this->evaluation->setVisible(LogicTester::evaluate($moduleInstance->visibleLogic));
        $this->evaluation->setMandatory(LogicTester::evaluate($moduleInstance->mandatoryLogic));
        $this->evaluation->setActive(LogicTester::evaluate($moduleInstance->activeLogic));
        $this->evaluation->setComplete(CompletionTester::evaluate($moduleInstance));

        return $this->evaluation;
    }
}
