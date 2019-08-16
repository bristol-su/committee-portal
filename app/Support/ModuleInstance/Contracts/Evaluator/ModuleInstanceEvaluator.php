<?php


namespace App\Support\ModuleInstance\Contracts\Evaluator;


use App\Support\Activity\Activity;
use App\Support\ModuleInstance\Contracts\ModuleInstance;

interface ModuleInstanceEvaluator
{

    public function evaluateParticipant(ModuleInstance $moduleInstance);

    public function evaluateAdministrator(ModuleInstance $moduleInstance);
}
