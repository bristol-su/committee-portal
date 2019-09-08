<?php


namespace Tests\Integration\Support\Permissions\Facade;


use App\Support\Permissions\Contracts\PermissionStore;
use App\Support\Permissions\Facade\Permission as PermissionFacade;
use App\Support\Permissions\Models\Permission;
use Prophecy\Argument;
use Tests\TestCase;

class PermissionTest extends TestCase
{

    /** @test */
    public function register_can_be_called_from_the_facade(){
        $permission = $this->prophesize(PermissionStore::class);
        $permission->registerPermission(Argument::any())->shouldBeCalled();
        $this->instance(PermissionStore::class, $permission->reveal());

        $permission = new Permission('a', 'b', 'c');
        PermissionFacade::registerPermission($permission);
    }

}
