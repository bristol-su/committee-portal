<?php


namespace Tests\Integration\Support\Completion\Facade;


use App\Support\Completion\Contracts\CompletionTester;
use App\Support\Completion\Facade\CompletionTester as CompletionTesterFacade;
use App\Support\ModuleInstance\ModuleInstance;
use Prophecy\Argument;
use Tests\TestCase;

class CompletionTesterTest extends TestCase
{

    /** @test */
    public function evaluate_calls_the_evaluate_method(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $completionTester = $this->prophesize(CompletionTester::class);
        $completionTester->evaluate(Argument::that(function($moduleInstanceArg) use ($moduleInstance) {
            return $moduleInstanceArg->id === $moduleInstance->id;
        }))->shouldBeCalled();

        $this->instance(CompletionTester::class, $completionTester->reveal());

        CompletionTesterFacade::evaluate($moduleInstance);
    }

}
