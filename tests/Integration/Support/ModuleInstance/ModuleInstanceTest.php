<?php


namespace Tests\Integration\Support\Module\ModuleInstance;


use App\Support\Activity\Activity;
use App\Support\ModuleInstance\ModuleInstance;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ModuleInstanceTest extends TestCase
{

    /** @test */
    public function it_has_a_module_instance_setting()
    {
        $settings = factory(ModuleInstanceSettings::class)->create();
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_settings_id' => $settings->id
        ]);
        $this->assertModelEquals($settings, $moduleInstance->moduleInstanceSettings);
    }

    /** @test */
    public function it_has_an_activity()
    {
        $activity = factory(Activity::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 10)->make();
        $activity->moduleInstances()->saveMany($moduleInstances);

        foreach ($moduleInstances as $moduleInstance) {
            $this->assertTrue($activity->is(
                $moduleInstance->activity
            ));
        }
    }

    /** @test */
    public function it_has_a_module_instance_permission()
    {

    }

    /** @test */
    public function it_has_active_logic(){

    }

    /** @test */
    public function it_has_visible_logic(){

    }

    /** @test */
    public function it_has_mandatory_logic(){

    }

    /** @test */
    public function id_returns_the_id()
    {
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->assertEquals($moduleInstance->id, $moduleInstance->id());
    }


    /** @test */
    public function alias_returns_the_alias()
    {
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->assertEquals($moduleInstance->alias, $moduleInstance->alias());
    }

    /** @test */
    public function it_creates_a_slug_when_being_created()
    {

    }

    /** @test */
    public function it_does_not_create_a_slug_if_the_slug_is_given()
    {

    }

}
