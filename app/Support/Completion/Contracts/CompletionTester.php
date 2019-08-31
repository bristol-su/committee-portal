<?php


namespace App\Support\Completion\Contracts;


use App\Support\ModuleInstance\Contracts\ModuleInstance;

interface CompletionTester
{

    public function evaluate(ModuleInstance $moduleInstance, $modelId = null): bool;

}
