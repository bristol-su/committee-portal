<?php


namespace Tests\Unit\Support\Logic;


use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Control\Models\Contracts\Group as GroupContract;
use App\Support\Control\Models\Contracts\Role as RoleContract;
use App\Support\Logic\AuthenticationModelFactory;
use App\Support\Logic\Contracts\FilterFactory as FilterFactoryContract;
use App\Support\Logic\LogicTester;
use App\User;
use Exception;
use Tests\TestCase;

class AuthenticationModelFactoryTest extends TestCase
{
    /** @test */
    public function it_gets_a_group_model_if_the_filter_requires_it()
    {
        $group = $this->prophesize(GroupContract::class);
        $authentication = $this->prophesize(AuthenticationContract::class);
        $authentication->getGroup()->willReturn($group->reveal());

        $authenticationModelFactory = new AuthenticationModelFactory($authentication->reveal());
        $this->assertInstanceOf(GroupContract::class, $authenticationModelFactory->createFromString('group'));
    }


    /** @test */
    public function it_gets_a_role_model_if_the_filter_requires_it()
    {
        $role = $this->prophesize(RoleContract::class);
        $authentication = $this->prophesize(AuthenticationContract::class);
        $authentication->getRole()->willReturn($role->reveal());

        $authenticationModelFactory = new AuthenticationModelFactory($authentication->reveal());
        $this->assertInstanceOf(RoleContract::class, $authenticationModelFactory->createFromString('role'));
    }


    /** @test */
    public function it_gets_a_user_model_if_the_filter_requires_it()
    {
        $user = $this->prophesize(User::class);
        $authentication = $this->prophesize(AuthenticationContract::class);
        $authentication->getUser()->willReturn($user->reveal());

        $authenticationModelFactory = new AuthenticationModelFactory($authentication->reveal());
        $this->assertInstanceOf(User::class, $authenticationModelFactory->createFromString('user'));
    }


    /** @test */
    public function it_throws_an_exception_if_the_filter_valid_for_is_invalid()
    {
        $authentication = $this->prophesize(AuthenticationContract::class);
        $authenticationModelFactory = new AuthenticationModelFactory($authentication->reveal());

        $this->expectException(Exception::class);
        $authenticationModelFactory->createFromString('invalidmodeltype');
    }
}