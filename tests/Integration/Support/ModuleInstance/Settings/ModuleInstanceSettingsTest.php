<?php


namespace Tests\Integration\Support\ModuleInstance\Settings;


use App\Support\Module\Settings\ModuleInstanceSettings;
use App\Support\ModuleInstance\ModuleInstance;
use Tests\TestCase;

class ModuleInstanceSettingsTest extends TestCase
{

    /** @test */
    public function it_has_a_module_instance()
    {
        $settings = factory(ModuleInstanceSettings::class)->create();
        $moduleInstance = factory(ModuleInstance::class)->create(['module_instance_settings_id' => $settings->id]);
        $this->assertInstanceOf(ModuleInstance::class, $settings->moduleInstance);
        $this->assertModelEquals($moduleInstance, $settings->moduleInstance);
    }

}
