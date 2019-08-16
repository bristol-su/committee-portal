<?php


namespace Tests\Integration\Support\Module\Permissions;


use App\Support\Logic\Contracts\LogicTester;
use App\Support\Logic\Logic;
use App\Support\Permissions\SitewidePermission;
use App\User;
use Prophecy\Argument;
use Tests\TestCase;

class SitewidePermissionTest extends TestCase
{

    /** @test */
    public function it_returns_true_if_the_user_has_a_true_logic(){
        $user = factory(User::class)->create();
        $logic = factory(Logic::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $permissionOverride = factory(SitewidePermission::class)->create([
            'user_id' => $user->id,
            'permission' => 'some-permission',
            'logic_id' => $logic->id
        ]);

        $this->assertTrue(SitewidePermission::passes($user, 'some-permission'));
    }

    /** @test */
    public function it_returns_false_if_the_user_has_a_false_logic(){
        $user = factory(User::class)->create();
        $logic = factory(Logic::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $permissionOverride = factory(SitewidePermission::class)->create([
            'user_id' => $user->id,
            'permission' => 'some-permission',
            'logic_id' => $logic->id
        ]);

        $this->assertFalse(SitewidePermission::passes($user, 'some-permission'));
    }

    /** @test */
    public function it_returns_null_if_the_user_has_no_matching_logic(){
        $user = factory(User::class)->create();
        $this->assertNull(SitewidePermission::passes($user, 'some-permission'));
    }

    /** @test */
    public function it_returns_null_if_the_user_has_logic_for_a_different_permission(){
        $user = factory(User::class)->create();
        $permissionOverride = factory(SitewidePermission::class)->create([
            'user_id' => $user->id,
            'permission' => 'some-permission',
        ]);

        $this->assertNull(SitewidePermission::passes($user, 'some-other-permission'));
    }

}
