<?php


namespace Tests\Integration\Support\Module\ModuleInstance;


use App\Support\Event\Event;
use App\Support\Module\ModuleInstance\ModuleInstance;
use App\Support\Module\Registration\OverrideAttribute;
use Tests\TestCase;

class ModuleInstanceTest extends TestCase
{

    /** @test */
    public function it_has_a_relationship_with_an_override_attribute_table(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $overrideAttribute = factory(OverrideAttribute::class)->create([
            'module_instance_id' => $moduleInstance->id
        ]);

        $this->assertTrue($overrideAttribute->is(
            $moduleInstance->overrideAttribute
        ));
    }

    /** @test */
    public function it_has_an_id(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->assertEquals($moduleInstance->id, $moduleInstance->id());
    }

    /** @test */
    public function it_has_an_alias(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->assertEquals($moduleInstance->alias, $moduleInstance->alias());
    }
    
    /** @test */
    public function it_has_an_event_relationship(){
        $event = factory(Event::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 10)->make();
        $event->moduleInstances()->saveMany($moduleInstances);

        foreach($moduleInstances as $moduleInstance) {
            $this->assertTrue($event->is(
                $moduleInstance->event
            ));
        }
    }

}