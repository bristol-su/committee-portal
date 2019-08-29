<?php


namespace Tests\Integration\Support\Completion;


use App\Support\Activity\Activity;
use App\Support\Completion\EventStore;
use App\Support\Logic\Logic;
use App\Support\ModuleInstance\ModuleInstance;
use Tests\TestCase;

class EventStoreTest extends TestCase
{

    /** @test */
    public function it_has_a_module_instance(){
        $eventStore = factory(EventStore::class)->create();
        $this->assertInstanceOf(ModuleInstance::class, $eventStore->moduleInstance);
        $this->assertEquals($eventStore->module_instance_id, $eventStore->moduleInstance->id);
    }

    /** @test */
    public function it_has_an_activity(){
        $eventStore = factory(EventStore::class)->create();
        $this->assertInstanceOf(Activity::class, $eventStore->activity);
        $this->assertEquals($eventStore->activity_id, $eventStore->activity->id);
    }

}
