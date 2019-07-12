<?php


namespace Tests\Integration\Http\Controllers\Settings;


use App\Support\Module\ModuleInstance\ModuleInstance;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Tests\TestCase;

class ModuleInstanceSettingsControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->beSuperAdmin();
    }

    /** @test */
    public function it_creates_a_new_settings_model(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $response = $this->json('post', '/admin/settings/moduleinstance/'.$moduleInstance->id.'/settings', ['settings' => [
            'setting1' => 'foo',
            'setting2' => 'bar'
        ]]);

        $this->assertDatabaseHas('module_instance_settings', ['settings' => json_encode([
            'setting1' => 'foo', 'setting2' => 'bar'
        ])]);
    }

    /** @test */
    public function it_attaches_the_settings_model_to_the_module_instance(){
        $moduleInstance = factory(ModuleInstance::class)->create(
            ['module_instance_settings_id' => null]
        );
        $response = $this->json('post', '/admin/settings/moduleinstance/'.$moduleInstance->id.'/settings', ['settings' => [
            'setting1' => 'foo',
            'setting2' => 'bar'
        ]]);

        $moduleInstance->refresh();
        $this->assertInstanceOf(ModuleInstanceSettings::class, $moduleInstance->moduleInstanceSettings);
        $this->assertEquals([
            'setting1' => 'foo', 'setting2' => 'bar'
        ], $moduleInstance->moduleInstanceSettings->settings);
    }

}