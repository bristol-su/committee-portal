<?php


namespace Tests\Integration\Support\Module\Registration;


use App\Support\Module\ModuleInstance\ModuleInstance;
use App\Support\Module\ModuleInstance\ModuleInstanceRepository;
use App\Support\Module\Registration\OverrideAttribute;
use App\Support\Module\Registration\OverrideAttributeRepository;
use Tests\TestCase;

class OverrideAttributeRepositoryTest extends TestCase
{

    /** @test */
    public function it_retrieves_overrides_for_a_specific_module_instance_id(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $overrideAttribute = factory(OverrideAttribute::class)->make();
        $moduleInstance->overrideAttribute()->save($overrideAttribute);

        $overrideAttributeRepository = new OverrideAttributeRepository(new ModuleInstanceRepository);

        $this->assertTrue($overrideAttribute->is(
            $overrideAttributeRepository->getByModuleInstanceId($moduleInstance->id)
        ));
    }

}