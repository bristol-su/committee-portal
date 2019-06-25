<?php


namespace Tests\Integration\Support\Module\Registration;


use App\Support\Module\ModuleInstance\ModuleInstance;
use App\Support\Module\Registration\OverrideAttribute;
use Tests\TestCase;

class OverrideAttributeTest extends TestCase
{

    /** @test */
    public function it_has_a_relationship_with_a_module_instance()
    {
        $moduleInstance = factory(ModuleInstance::class)->create();
        $overrideAttribute = factory(OverrideAttribute::class)->create([
            'module_instance_id' => $moduleInstance->id
        ]);

        $this->assertTrue($moduleInstance->is(
            $overrideAttribute->moduleInstance
        ));
    }

}