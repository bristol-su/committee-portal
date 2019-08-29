<?php


namespace Tests\Integration\Http\Controllers\Api;


use App\Support\Logic\Logic;
use App\Support\Permissions\ModuleInstancePermissions;
use Tests\TestCase;

class ModuleInstancePermissionControllerTest extends TestCase
{

    /** @test */
    public function show_returns_404_if_permission_not_found(){
        $response = $this->json('get', '/api/module_instance_permission/1');
        $response->assertStatus(404);
    }

    /** @test */
    public function show_returns_the_permission(){
        $permission = factory(ModuleInstancePermissions::class)->create();
        $response = $this->json('get', '/api/module_instance_permission/' . $permission->id);
        $response->assertJson($permission->toArray());
    }

    /** @test */
    public function store_stores_permission_in_the_database(){
        $logic = factory(Logic::class)->create();
        $parameters = [
            'participant_permissions' => ['one' => $logic->id, 'two' => $logic->id],
            'admin_permissions' => ['three' => $logic->id, 'four' => $logic->id],
        ];

        $response = $this->json('post', '/api/module_instance_permission', $parameters);
        $response->assertStatus(201);

        $this->assertDatabaseHas('module_instance_permissions', [
            'participant_permissions' => json_encode(['one' => $logic->id, 'two' => $logic->id]),
            'admin_permissions' => json_encode(['three' => $logic->id, 'four' => $logic->id]),
        ]);
    }

    /** @test */
    public function store_returns_the_permission(){
        $logic = factory(Logic::class)->create();
        $parameters = [
            'participant_permissions' => ['one' => $logic->id, 'two' => $logic->id],
            'admin_permissions' => ['three' => $logic->id, 'four' => $logic->id],
        ];

        $response = $this->json('post', '/api/module_instance_permission', $parameters);
        $response->assertStatus(201);
        $response->assertJson($parameters);
    }

    /** @test */
    public function update_updates_the_participant_permission_if_given(){
        $permission = factory(ModuleInstancePermissions::class)->create();
        $logic = factory(Logic::class)->create();
        $response = $this->json('patch', '/api/module_instance_permission/' . $permission->id, [
            'participant_permissions' => ['one' => $logic->id]
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('module_instance_permissions', [
            'participant_permissions' => json_encode(['one' => $logic->id]),
            'admin_permissions' => json_encode($permission->admin_permissions),
        ]);
    }

    /** @test */
    public function update_updates_the_administrator_permission_if_given(){
        $permission = factory(ModuleInstancePermissions::class)->create();
        $logic = factory(Logic::class)->create();
        $response = $this->json('patch', '/api/module_instance_permission/' . $permission->id, [
            'admin_permissions' => ['one' => $logic->id]
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('module_instance_permissions', [
            'admin_permissions' => json_encode(['one' => $logic->id]),
            'participant_permissions' => json_encode($permission->participant_permissions),
        ]);
    }

    /** @test */
    public function update_updates_both_permissions_if_given(){
        $permission = factory(ModuleInstancePermissions::class)->create();
        $logic = factory(Logic::class)->create();
        $response = $this->json('patch', '/api/module_instance_permission/' . $permission->id, [
            'participant_permissions' => ['one' => $logic->id],
            'admin_permissions' => ['two' => $logic->id]
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('module_instance_permissions', [
            'participant_permissions' => json_encode(['one' => $logic->id]),
            'admin_permissions' => json_encode(['two' => $logic->id]),
        ]);
    }

    /** @test */
    public function update_updates_neither_permissions_if_neither_given(){
        $permission = factory(ModuleInstancePermissions::class)->create();
        $response = $this->json('patch', '/api/module_instance_permission/' . $permission->id, []);
        $response->assertStatus(200);

        $this->assertDatabaseHas('module_instance_permissions', [
            'participant_permissions' => json_encode($permission->participant_permissions),
            'admin_permissions' => json_encode($permission->admin_permissions),
        ]);
    }

}
