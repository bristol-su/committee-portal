<?php


namespace Tests\Integration\Support\Logic\Facade;


use App\Support\Logic\Contracts\LogicTester;
use App\Support\Logic\Logic;
use Prophecy\Argument;
use Tests\TestCase;

class LogicTesterTest extends TestCase
{

    /** @test */
    public function evaluate_can_be_called(){
        $logic = factory(Logic::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArg) use ($logic) {
            return $logicArg->id === $logic->id;
        }))->shouldBeCalled();
        $this->instance(LogicTester::class, $logicTester->reveal());

        \App\Support\Logic\Facade\LogicTester::evaluate($logic);
    }

}
