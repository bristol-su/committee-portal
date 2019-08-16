<?php


namespace Tests\Integration\Support\Logic;


use App\Support\Filters\FilterInstance;
use App\Support\Logic\Logic;
use Tests\TestCase;

class LogicTest extends TestCase
{

    /** @test */
    public function it_has_all_true_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_true'
        ]);

        $this->assertCount(1, $logic->allTrueFilters);
        $this->assertModelEquals($filterInstance, $logic->allTrueFilters->first());
    }

    /** @test */
    public function all_true_filters_is_an_empty_array_if_logic_has_no_all_true_filters(){
        $logic = factory(Logic::class)->create();
        $this->assertIsArray($logic->allTrueFilters->toArray());
        $this->assertEmpty($logic->allTrueFilters->toArray());
    }

    /** @test */
    public function all_true_only_returns_all_true_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_true'
        ]);
        $filterInstance2 = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_false'
        ]);

        $this->assertCount(1, $logic->allTrueFilters);
        $this->assertModelEquals($filterInstance, $logic->allTrueFilters->first());
    }

    /** @test */
    public function it_has_all_false_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_false'
        ]);

        $this->assertCount(1, $logic->allFalseFilters);
        $this->assertModelEquals($filterInstance, $logic->allFalseFilters->first());
    }

    /** @test */
    public function it_has_any_true_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'any_true'
        ]);

        $this->assertCount(1, $logic->anyTrueFilters);
        $this->assertModelEquals($filterInstance, $logic->anyTrueFilters->first());
    }

    /** @test */
    public function it_has_any_false_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'any_false'
        ]);

        $this->assertCount(1, $logic->anyFalseFilters);
        $this->assertModelEquals($filterInstance, $logic->anyFalseFilters->first());
    }

}
