<?php


namespace Tests\Integration\Support\Permissions\Models;


use App\Support\Control\Models\Group;
use App\Support\Logic\Logic;
use App\Support\Permissions\Models\ModelPermission;
use App\User;
use Tests\TestCase;

class ModelPermissionTest extends TestCase
{

    /** @test */
    public function user_returns_all_user_permissions(){
        $userPermissions = factory(ModelPermission::class, 5)->state('user')->create();
        $groupPermissions = factory(ModelPermission::class, 5)->state('group')->create();

        $permissions = ModelPermission::user()->get();

        foreach($userPermissions as $permission) {
            $this->assertTrue($permissions->contains($permission));
        }
        foreach($groupPermissions as $permission) {
            $this->assertFalse($permissions->contains($permission));
        }

    }

    /** @test */
    public function user_can_select_by_user_id_and_ability(){
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user4 = factory(User::class)->create();
        $userPermission1 = factory(ModelPermission::class)->state('user')->create(['ability' => 'permission1', 'model_id' => $user1->id]);
        $userPermission2 = factory(ModelPermission::class)->state('user')->create(['ability' => 'permission2', 'model_id' => $user2->id]);
        $userPermission3 = factory(ModelPermission::class)->state('user')->create(['ability' => 'permission3', 'model_id' => $user1->id]);
        $userPermission4 = factory(ModelPermission::class)->state('user')->create(['ability' => 'permission1', 'model_id' => $user4->id]);

        $permission = ModelPermission::user($user1->id, 'permission1')->get();

        $this->assertCount(1, $permission);
        $this->assertModelEquals($userPermission1, $permission->first());
    }

    /** @test */
    public function group_can_select_by_group_id_and_ability(){
        $group1 = new Group(['id' => 1]);
        $group2 = new Group(['id' => 2]);
        $group4 = new Group(['id' => 3]);
        $groupPermission1 = factory(ModelPermission::class)->state('group')->create(['ability' => 'permission1', 'model_id' => $group1->id]);
        $groupPermission2 = factory(ModelPermission::class)->state('group')->create(['ability' => 'permission2', 'model_id' => $group2->id]);
        $groupPermission3 = factory(ModelPermission::class)->state('group')->create(['ability' => 'permission3', 'model_id' => $group1->id]);
        $groupPermission4 = factory(ModelPermission::class)->state('group')->create(['ability' => 'permission1', 'model_id' => $group4->id]);

        $permission = ModelPermission::group($group1->id, 'permission1')->get();

        $this->assertCount(1, $permission);
        $this->assertEquals($groupPermission1->id, $permission->first()->id);
    }


    /** @test */
    public function group_returns_all_group_permissions(){
        $userPermissions = factory(ModelPermission::class, 5)->state('user')->create();
        $groupPermissions = factory(ModelPermission::class, 5)->state('group')->create();

        $permissions = ModelPermission::group()->get();

        foreach($userPermissions as $permission) {
            $this->assertFalse($permissions->contains($permission));
        }
        foreach($groupPermissions as $permission) {
            $this->assertTrue($permissions->contains($permission));
        }
    }



    /** @test */
    public function logic_returns_all_logic_permissions(){
        $logicPermissions = factory(ModelPermission::class, 5)->state('logic')->create();
        $groupPermissions = factory(ModelPermission::class, 5)->state('group')->create();

        $permissions = ModelPermission::logic()->get();

        foreach($logicPermissions as $permission) {
            $this->assertTrue($permissions->contains($permission));
        }
        foreach($groupPermissions as $permission) {
            $this->assertFalse($permissions->contains($permission));
        }

    }

    /** @test */
    public function logic_can_select_by_logic_id_and_ability(){
        $logic1 = factory(Logic::class)->create();
        $logic2 = factory(Logic::class)->create();
        $logic4 = factory(Logic::class)->create();
        $logicPermission1 = factory(ModelPermission::class)->state('logic')->create(['ability' => 'permission1', 'model_id' => $logic1->id]);
        $logicPermission2 = factory(ModelPermission::class)->state('logic')->create(['ability' => 'permission2', 'model_id' => $logic2->id]);
        $logicPermission3 = factory(ModelPermission::class)->state('logic')->create(['ability' => 'permission3', 'model_id' => $logic1->id]);
        $logicPermission4 = factory(ModelPermission::class)->state('logic')->create(['ability' => 'permission1', 'model_id' => $logic4->id]);

        $permission = ModelPermission::logic($logic1->id, 'permission1')->get();

        $this->assertCount(1, $permission);
        $this->assertModelEquals($logicPermission1, $permission->first());
    }


}
