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

}
