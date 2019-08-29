<?php


namespace Tests\Integration\Http\Controllers\Api;


use App\Support\Logic\Logic;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Tests\TestCase;

class ModuleInstanceSettingControllerTest extends TestCase
{
    /** @test */
    public function show_returns_404_if_setting_not_found(){
        $response = $this->json('get', '/api/module_instance_setting/1');
        $response->assertStatus(404);
    }

    /** @test */
    public function show_returns_the_setting(){
        $setting = factory(ModuleInstanceSettings::class)->create();
        $response = $this->json('get', '/api/module_instance_setting/' . $setting->id);
        $response->assertJson($setting->toArray());
    }

    /** @test */
    public function store_stores_setting_in_the_database(){
        $logic = factory(Logic::class)->create();
        $parameters = ['settings' => ['one' => 'bar', 'two' => 'baz']];

        $response = $this->json('post', '/api/module_instance_setting', $parameters);
        $response->assertStatus(201);

        $this->assertDatabaseHas('module_instance_settings', [
            'settings' => json_encode(['one' => 'bar', 'two' => 'baz'])
        ]);
    }

    /** @test */
    public function store_returns_the_setting(){
        $logic = factory(Logic::class)->create();
        $parameters = ['settings' => ['one' => 'bar', 'two' => 'baz']];

        $response = $this->json('post', '/api/module_instance_setting', $parameters);
        $response->assertStatus(201);
        $response->assertJson($parameters);
    }

    /** @test */
    public function update_updates_the_setting_if_given(){
        $setting = factory(ModuleInstanceSettings::class)->create([
            'settings' => ['one' => 'foo', 'two' => 'baz']
        ]);
        $response = $this->json('patch', '/api/module_instance_setting/' . $setting->id, [
            'settings' => ['three' => 'foo', 'four' => 'baz']
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('module_instance_settings', ['settings' => json_encode(['three' => 'foo', 'four' => 'baz'])]);
    }


    /** @test */
    public function update_does_not_update_settings_if_not_given(){
        $setting = factory(ModuleInstanceSettings::class)->create();
        $response = $this->json('patch', '/api/module_instance_setting/' . $setting->id, []);
        $response->assertStatus(200);

        $this->assertDatabaseHas('module_instance_settings', ['settings' => json_encode($setting->settings)]);

    }

}
