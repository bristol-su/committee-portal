<?php


namespace Tests\Integration\Support\Permissions\Testers;


use App\Support\Logic\Contracts\LogicTester;
use App\Support\Logic\Logic;
use App\Support\Permissions\Contracts\Testers\Tester;
use App\Support\Permissions\Models\ModelPermission;
use App\Support\Permissions\Testers\SystemLogicPermission;
use App\User;
use Tests\TestCase;

class SystemLogicPermissionTest extends TestCase
{

    /** @test */
    public function can_calls_successor_if_no_logic_permission_found(){
        $logicTester = $this->prophesize(LogicTester::class);
        $tester = new SystemLogicPermission($logicTester->reveal());

        $fakeTester = $this->prophesize(Tester::class);
        $fakeTester->can('notfound')->shouldBeCalled();
        $tester->setNext($fakeTester->reveal());

        $tester->can('notfound');
    }

    /** @test */
    public function can_calls_successor_if_no_logic_permission_is_evaluated_as_true(){
        $falseLogic = factory(Logic::class)->create();
        $this->createLogicTester([], [$falseLogic]);

        $permission = factory(ModelPermission::class)->state('logic')->create(['model_id' => $falseLogic->id, 'ability' => 'nottrue']);

        $tester = new SystemLogicPermission($this->app->make(LogicTester::class));
        $fakeTester = $this->prophesize(Tester::class);
        $fakeTester->can('nottrue')->shouldBeCalled();
        $tester->setNext($fakeTester->reveal());

        $tester->can('nottrue');
    }

    /** @test */
    public function can_returns_the_result_of_the_permission_if_evaluated_as_true(){
        $trueLogic = factory(Logic::class)->create();
        $falseLogic = factory(Logic::class)->create();
        $this->createLogicTester([$trueLogic], [$falseLogic]);

        $permissionFalse = factory(ModelPermission::class)->state('logic')->create(['model_id' => $falseLogic->id, 'ability' => 'inlogicgroup']);
        $permissionTrue = factory(ModelPermission::class)->state('logic')->create(['model_id' => $trueLogic->id, 'ability' => 'inlogicgroup', 'result' => true]);

        $tester = new SystemLogicPermission($this->app->make(LogicTester::class));

        $this->assertTrue(
            $tester->can('inlogicgroup')
        );
    }


}
