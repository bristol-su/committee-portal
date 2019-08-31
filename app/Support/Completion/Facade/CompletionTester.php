<?php


namespace App\Support\Completion\Facade;


use App\Support\Completion\Contracts\CompletionTester as CompletionTesterContract;
use App\Support\ModuleInstance\ModuleInstance;
use Clockwork\Support\Laravel\Facade;

/**
 * Class CompletionTester
 * @method static bool evaluate(ModuleInstance $moduleInstance, int $modelId = null) Test if the module instance has been completed by the given model ID
 * @package App\Support\Completion\Facade
 */
class CompletionTester extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CompletionTesterContract::class;
    }
}
