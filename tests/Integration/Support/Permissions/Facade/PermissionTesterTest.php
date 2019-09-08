<?php


namespace Tests\Integration\Support\Permissions\Facade;


use App\Support\Permissions\Contracts\PermissionStore;
use App\Support\Permissions\Contracts\PermissionTester;
use App\Support\Permissions\Facade\Permission as PermissionFacade;
use App\Support\Permissions\Facade\PermissionTester as PermissionTesterFacade;
use App\Support\Permissions\Models\Permission;
use Prophecy\Argument;
use Tests\TestCase;

class PermissionTesterTest extends TestCase
{
    /** @test */
    public function register_can_be_called_from_the_facade()
    {
        $permission = $this->prophesize(PermissionTester::class);
        $permission->evaluate('permission.here')->shouldBeCalled();
        $this->instance(PermissionTester::class, $permission->reveal());

        PermissionTesterFacade::evaluate('permission.here');
    }
}
