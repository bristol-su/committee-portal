<?php


namespace Tests\Integration\Http\Controllers\Api;


use App\Support\Activity\Activity;
use App\Support\Logic\Logic;
use App\Support\Module\Settings\ModuleInstanceSettings;
use App\Support\Permissions\ModuleInstancePermissions;
use Tests\TestCase;

class ModuleInstanceControllerTest extends TestCase
{

    /** @test */
    public function store_creates_a_module_instance_in_the_database(){
        $attributes = [
            'alias' => 'fileupload',
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
            'alias' => 'fileupload',
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
