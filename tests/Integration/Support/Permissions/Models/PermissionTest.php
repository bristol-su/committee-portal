<?php


namespace Tests\Integration\Support\Permissions\Models;


use App\Support\Permissions\Models\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{

    /** @test */
    public function ability_can_be_set_and_got(){
        $ability = 'ability';

        $permission = new Permission;
        $permission->setAbility($ability);

        $this->assertEquals($ability, $permission->getAbility());
    }

    /** @test */
    public function name_can_be_set_and_got(){
        $name = 'name';

        $permission = new Permission;
        $permission->setName($name);

        $this->assertEquals($name, $permission->getName());
    }


    /** @test */
    public function description_can_be_set_and_got(){
        $description = 'description';

        $permission = new Permission;
        $permission->setDescription($description);

        $this->assertEquals($description, $permission->getDescription());
    }

    /** @test */
    public function type_can_be_set_and_got(){
        $type = 'global';

        $permission = new Permission;
        $permission->setType($type);

        $this->assertEquals($type, $permission->getType());
    }

    /** @test */
    public function module_type_can_be_set_and_got(){
        $moduleType = 'admin';

        $permission = new Permission;
        $permission->setModuleType($moduleType);

        $this->assertEquals($moduleType, $permission->getModuleType());
    }

    /** @test */
    public function module_alias_can_be_set_and_got(){
        $moduleAlias = 'fileupload';

        $permission = new Permission;
        $permission->setModuleAlias($moduleAlias);

        $this->assertEquals($moduleAlias, $permission->getModuleAlias());
    }

    /** @test */
    public function all_can_be_set_through_the_constructor(){
        $ability = 'ability';
        $name = 'name';
        $description = 'description';
        $type = 'module';
        $alias = 'fileupload';
        $moduleType = 'administrator';

        $permission = new Permission($ability, $name, $description, $type, $alias, $moduleType);

        $this->assertEquals($ability, $permission->getAbility());
        $this->assertEquals($name, $permission->getName());
        $this->assertEquals($description, $permission->getDescription());
        $this->assertEquals($type, $permission->getType());
        $this->assertEquals($alias, $permission->getModuleAlias());
        $this->assertEquals($moduleType, $permission->getModuleType());

    }

    /** @test */
    public function toArray_returns_all_attributes_as_an_array(){
        $ability = 'ability';
        $name = 'name';
        $description = 'description';
        $type = 'module';
        $alias = 'fileupload';
        $moduleType = 'administrator';

        $permission = new Permission($ability, $name, $description, $type, $alias, $moduleType);

        $this->assertEquals([
            'ability' => $ability,
            'name' => $name,
            'description' => $description,
            'type' => $type,
            'alias' => $alias,
            'module_type' => $moduleType
        ], $permission->toArray());
    }

}
