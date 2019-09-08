<?php


namespace Tests\Integration\Support\Permissions;


use App\Support\Permissions\Contracts\Models\Permission;
use App\Support\Permissions\PermissionStore;
use Tests\TestCase;

class PermissionStoreTest extends TestCase
{

    /** @test */
    public function registerPermission_registers_a_permission_to_the_store(){
        $ability = 'ability';
        $name = 'name';
        $description = 'description';
        $type = 'global';

        $permission = new \App\Support\Permissions\Models\Permission($ability, $name, $description, $type);
        $permissionStore = new PermissionStore();
        $permissionStore->registerPermission($permission);

        $this->assertEquals($ability, $permissionStore->get($ability)->getAbility());
        $this->assertEquals($name, $permissionStore->get($ability)->getName());
        $this->assertEquals($description, $permissionStore->get($ability)->getDescription());
        $this->assertEquals($type, $permissionStore->get($ability)->getType());

    }

    /** @test */
    public function register_site_permission_registers_a_permission_by_attributes(){
        $ability = 'ability';
        $name = 'name';
        $description = 'description';

        $permissionStore = new PermissionStore();
        $permissionStore->registerSitePermission($ability, $name, $description);

        $this->assertEquals($ability, $permissionStore->get($ability)->getAbility());
        $this->assertEquals($name, $permissionStore->get($ability)->getName());
        $this->assertEquals($description, $permissionStore->get($ability)->getDescription());
        $this->assertEquals('global', $permissionStore->get($ability)->getType());
    }

    /** @test */
    public function register_registers_a_module_permission_by_attributes(){
        $ability = 'ability';
        $name = 'name';
        $description = 'description';
        $alias = 'fileupload';
        $admin = true;

        $permissionStore = new PermissionStore();
        $permissionStore->register($ability, $name, $description, $alias, $admin);

        $this->assertEquals($ability, $permissionStore->get($ability)->getAbility());
        $this->assertEquals($name, $permissionStore->get($ability)->getName());
        $this->assertEquals($description, $permissionStore->get($ability)->getDescription());
        $this->assertEquals('module', $permissionStore->get($ability)->getType());
        $this->assertEquals($alias, $permissionStore->get($ability)->getModuleAlias());
        $this->assertEquals('administrator', $permissionStore->get($ability)->getModuleType());
    }

    /** @test */
    public function all_returns_all_permissions(){
        $permission1 = new \App\Support\Permissions\Models\Permission('a1', 'n1', 'd1', 'global');
        $permission2 = new \App\Support\Permissions\Models\Permission('a2', 'n2', 'd2', 'global');

        $permissionStore = new PermissionStore;
        $permissionStore->registerPermission($permission1);
        $permissionStore->registerPermission($permission2);

        $allPermissions = $permissionStore->all();
        $this->assertEquals($permission1, $allPermissions['a1']);
        $this->assertEquals($permission2, $allPermissions['a2']);
    }

    /** @test */
    public function get_throws_an_exception_if_ability_not_found(){
        $this->expectException(\Exception::class);
        $permissionStore = new PermissionStore();
        $permissionStore->get('non-existent');

    }

}
