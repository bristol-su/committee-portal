<?php


namespace Tests\Integration\Support\Event;


use App\Support\Event\Event;
use App\Support\Module\ModuleInstance\ModuleInstance;
use Tests\TestCase;

class EventTest extends TestCase
{

    /** @test */
    public function it_has_many_module_instances()
    {
        $event = factory(Event::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 10)->make();
        $event->moduleInstances()->saveMany($moduleInstances);

        for ($i = 0; $i < $moduleInstances->count(); $i++) {

            $this->assertTrue($moduleInstances[$i]->is(
                $event->moduleInstances[$i])
            );
        }
    }

}