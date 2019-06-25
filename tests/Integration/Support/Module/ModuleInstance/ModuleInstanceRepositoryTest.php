<?php

namespace Tests\Integration\Support\Module;

use App\Support\Event\Event;
use App\Support\Module\ModuleInstance\ModuleInstance;
use Tests\TestCase;
use App\Support\Module\ModuleInstance\ModuleInstanceRepository;

class ModuleInstanceRepositoryTest extends TestCase
{

    /** @test */
    public function it_retrieves_a_module_instance_by_id(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->assertDatabaseHas('module_instances', $moduleInstance->toArray());

        $repository = new ModuleInstanceRepository;
        $foundInstance = $repository->getById($moduleInstance->id);

        $this->assertInstanceOf(ModuleInstance::class, $foundInstance);
        $this->assertTrue($moduleInstance->is($foundInstance));
    }
    
    /** @test */
    public function it_creates_a_module_instance(){
        $repository = new ModuleInstanceRepository;
        $event = factory(Event::class)->create();
        $instance = $repository->create('alias', $event->id,'name', 'description', 1, 2, 3, 'complete');

        $this->assertDatabaseHas('module_instances', [
            'alias' => 'alias',
            'event_id' => $event->id,
            'name' => 'name',
            'description' => 'description',
            'active' => 1,
            'visible' => 2,
            'mandatory' => 3,
            'complete' => 'complete'
        ]);
    }
    
}