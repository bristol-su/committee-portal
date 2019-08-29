<?php


namespace Tests\Integration\Support\Module;


use App\Support\Module\Module;
use Illuminate\Config\Repository;
use Tests\TestCase;

class ModuleTest extends TestCase
{

    /** @test */
    public function alias_returns_the_alias_of_the_module(){
        $module = new Module('alias1', config());

        $this->assertEquals('alias1', $module->alias());
    }

    /** @test */
    public function to_array_returns_the_alias_and_configuration_information(){
        $configValue = ['key' => 'attribute'];
        $config = $this->prophesize(Repository::class);
        $config->get('alias1', [])->shouldBeCalled()->willReturn($configValue);

        $module = new Module('alias1', $config->reveal());

        $this->assertEquals([
            'alias' => 'alias1',
            'key' => 'attribute'
        ], $module->toArray());
    }

}
