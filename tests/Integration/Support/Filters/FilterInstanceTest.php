<?php


namespace Tests\Integration\Support\Filters;


use App\Support\Filters\FilterInstance;
use App\Support\Logic\Logic;
use Tests\TestCase;

class FilterInstanceTest extends TestCase
{

    /** @test */
    public function it_has_a_logic(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id
        ]);

        $this->assertModelEquals($logic, $filterInstance->logic);
    }

    /** @test */
    public function name_returns_the_filter_instance_name(){
        $filterInstance = factory(FilterInstance::class)->create(['name' => 'A name']);
        $this->assertEquals('A name', $filterInstance->name());
    }

    /** @test */
    public function alias_returns_the_filter_alias(){
        $filterInstance = factory(FilterInstance::class)->create(['alias' => 'alias1']);
        $this->assertEquals('alias1', $filterInstance->alias());
    }

    /** @test */
    public function settings_returns_the_filter_instance_settings(){
        $filterInstance = factory(FilterInstance::class)->create(['settings' => ['setting1' => 'A Value']]);
        $this->assertEquals(['setting1' => 'A Value'], $filterInstance->settings());
    }

}
