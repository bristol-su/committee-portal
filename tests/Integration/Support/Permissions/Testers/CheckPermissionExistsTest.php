<?php


namespace Tests\Integration\Support\Permissions\Testers;


use App\Support\Permissions\Contracts\PermissionRepository;
use App\Support\Permissions\Contracts\Testers\Tester;
use App\Support\Permissions\Models\Permission;
use App\Support\Permissions\Testers\CheckPermissionExists;
use Tests\TestCase;

class CheckPermissionExistsTest extends TestCase
{
    /** @test */
    public function can_returns_false_if_the_permission_is_not_registered(){
        $repository = $this->prophesize(PermissionRepository::class);
        $repository->get('ability')->shouldBeCalled()->willThrow(new \Exception);

        $tester = new CheckPermissionExists($repository->reveal());

        $this->assertFalse(
            $tester->can('ability')
        );
    }

    /** @test */
    public function can_calls_successor_if_the_permission_is_registered(){
        $repository = $this->prophesize(PermissionRepository::class);
        $repository->get('ability')->shouldBeCalled()->willReturn(new Permission);

        $tester = new CheckPermissionExists($repository->reveal());

        $fakeTester = $this->prophesize(Tester::class);
        $fakeTester->can('ability')->shouldBeCalled();
        $tester->setNext($fakeTester->reveal());

        $tester->can('ability');
    }
}
