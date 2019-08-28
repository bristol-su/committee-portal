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

    }

    /** @test */
    public function alias_returns_the_filter_alias(){

    }

    /** @test */
    public function settings_returns_the_filter_instance_settings(){

    }

}
