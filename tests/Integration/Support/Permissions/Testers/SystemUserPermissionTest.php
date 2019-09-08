<?php


namespace Tests\Integration\Support\Permissions\Testers;


use App\Support\Authentication\Contracts\Authentication;
use App\Support\Permissions\Contracts\Testers\Tester;
use App\Support\Permissions\Models\ModelPermission;
use App\Support\Permissions\Testers\SystemUserPermission;
use App\User;
use Tests\TestCase;

class SystemUserPermissionTest extends TestCase
{

    /** @test */
    public function can_calls_successor_if_user_not_logged_in(){
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getUser()->shouldBeCalled()->willReturn(null);

        $tester = new SystemUserPermission($authentication->reveal());

        $fakeTester = $this->prophesize(Tester::class);
        $fakeTester->can('notloggedin')->shouldBeCalled();
        $tester->setNext($fakeTester->reveal());

        $tester->can('notloggedin');
    }

    /** @test */
    public function can_calls_successor_if_no_permission_found(){
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getUser()->shouldBeCalled()->willReturn(factory(User::class)->create());
        $tester = new SystemUserPermission($authentication->reveal());

        $fakeTester = $this->prophesize(Tester::class);
        $fakeTester->can('notfound')->shouldBeCalled();
        $tester->setNext($fakeTester->reveal());

        $tester->can('notfound');
    }

    /** @test */
    public function can_returns_the_result_of_the_permission_if_found(){
        $user = factory(User::class)->create();
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getUser()->shouldBeCalled()->willReturn($user);
        $tester = new SystemUserPermission($authentication->reveal());

        $permission = factory(ModelPermission::class)->state('user')->create(['model_id' => $user->id, 'result' => true]);

        $tester->can($permission->ability);
    }


}
