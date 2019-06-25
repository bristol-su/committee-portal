<?php


namespace Tests\Unit\Support\Module\InformationGetter;


use App\Support\Module\Contracts\ModuleInstance;
use App\Support\Module\Contracts\OverrideAttributeRepository;
use App\Support\Module\Registration\ModuleInformationGetter;
use App\Support\Module\Registration\OverrideAttribute;
use Tests\TestCase;

class ModuleInformationGetterTest extends TestCase
{

    /** @test */
    public function it_overrides_default_configuration_with_repository_configuration(){
        $defaultAttributes = ['one' => 'foo','two' => 'foo'];
        $overrideAttribute = $this->prophesize(OverrideAttribute::class);
        $overrideAttribute->toArray()->willReturn(['two' => 'bar']);

        $this->app['config']->set('alias.registration', $defaultAttributes);
        $overrideAttributeRepository = $this->prophesize(OverrideAttributeRepository::class);
        $overrideAttributeRepository->getByModuleInstanceId(1)->willReturn($overrideAttribute->reveal());
        $moduleInstance = $this->prophesize(ModuleInstance::class);
        $moduleInstance->id()->willReturn(1);
        $moduleInstance->alias()->willReturn('alias');

        $moduleInformationGetter = new ModuleInformationGetter($overrideAttributeRepository->reveal());

        $this->assertEquals(['one' => 'foo', 'two' => 'bar'], $moduleInformationGetter->get($moduleInstance->reveal()));
    }

}