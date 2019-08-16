<?php

namespace Tests\Integration\Support\Module;

use App\Support\Activity\Activity;
use App\Support\ModuleInstance\ModuleInstance;
use Tests\TestCase;
use App\Support\ModuleInstance\ModuleInstanceRepository;

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
        $activity = factory(Activity::class)->create();
        $instance = $repository->create([
            'alias' => 'alias',
            'activity_id' => $activity->id,
            'name' => 'name',
            'description' => 'description',
            'active' => 1,
            'visible' => 2,
            'mandatory' => 3,
            'complete' => 'complete'
        ]);

        $this->assertDatabaseHas('module_instances', [
            'alias' => 'alias',
            'activity_id' => $activity->id,
            'name' => 'name',
            'description' => 'description',
            'active' => 1,
            'visible' => 2,
            'mandatory' => 3,
            'complete' => 'complete'
        ]);
    }

}
