<?php

namespace Tests;

use App\Support\Logic\Contracts\LogicTester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Prophecy\Argument;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    public function assertNotAuthenticated($guard = 'web')
    {
        $this->assertFalse($this->isAuthenticated($guard));

        return $this;
    }

    public function assertModelEquals(Model $expected, Model $actual)
    {
        $this->assertTrue($expected->is($actual), 'Models are not equal');
    }

    public function createLogicTester($true=[], $false=[]   )
    {
        $logicTester = $this->prophesize(LogicTester::class);
        foreach(Arr::wrap($true) as $logic) {
            $logicTester->evaluate(Argument::that(function($arg) use ($logic) {
                return $arg->id === $logic->id;
            }))->willReturn(true);
        }

        foreach(Arr::wrap($false) as $logic) {
            $logicTester->evaluate(Argument::that(function($arg) use ($logic) {
                return $arg->id === $logic->id;
            }))->willReturn(false);
        }

        $this->instance(LogicTester::class, $logicTester->reveal());
    }

}
