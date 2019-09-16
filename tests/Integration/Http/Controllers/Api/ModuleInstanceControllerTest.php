<?php


namespace Tests\Integration\Http\Controllers\Api;


use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Logic\Logic;
use BristolSU\Support\ModuleInstance\Settings\ModuleInstanceSettings;
use BristolSU\Support\Permissions\Models\ModuleInstancePermissions;
use BristolSU\Support\User\User;
use Tests\TestCase;

class ModuleInstanceControllerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user, 'api');
    }
    /** @test */
    public function store_creates_a_module_instance_in_the_database(){
        $attributes = [
            'alias' => 'alias1',
            'activity_id' => factory(Activity::class)->create()->id,
            'name' => 'Some Module',
            'slug' => 'a-module',
            'description' => 'Some Description of the module',
            'active' => factory(Logic::class)->create()->id,
            'visible' =>  factory(Logic::class)->create()->id,
            'mandatory' => factory(Logic::class)->create()->id,
            'complete' => 'completion_event',
            'module_instance_settings_id' => factory(ModuleInstanceSettings::class)->create()->id,
            'module_instance_permissions_id' => factory(ModuleInstancePermissions::class)->create()->id,
        ];

        $response = $this->json('post', '/api/module_instance', $attributes);
        $this->assertDatabaseHas('module_instances', $attributes);
    }

    /** @test */
    public function store_returns_a_module_instance(){
        $attributes = [
            'alias' => 'alias1',
            'activity_id' => factory(Activity::class)->create()->id,
            'name' => 'Some Module',
            'slug' => 'a-module',
            'description' => 'Some Description of the module',
            'active' => factory(Logic::class)->create()->id,
            'visible' =>  factory(Logic::class)->create()->id,
            'mandatory' => factory(Logic::class)->create()->id,
            'complete' => 'completion_event',
            'module_instance_settings_id' => factory(ModuleInstanceSettings::class)->create()->id,
            'module_instance_permissions_id' => factory(ModuleInstancePermissions::class)->create()->id,
        ];

        $response = $this->json('post', '/api/module_instance', $attributes);
        $response->assertJson($attributes);
    }

}
