<?php


namespace Tests\Integration\Support\Logic;


use App\Support\Filters\FilterInstance;
use App\Support\Logic\Logic;
use Illuminate\Support\Collection;
use Tests\TestCase;

class LogicTest extends TestCase
{

    /** @test */
    public function all_true_filters_returns_all_true_filters(){
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
    public function all_false_filters_returns_an_empty_array_if_no_all_false_filters(){
        $logic = factory(Logic::class)->create();
        $this->assertIsArray($logic->allFalseFilters->toArray());
        $this->assertEmpty($logic->allFalseFilters->toArray());
    }
    /** @test */
    public function all_false_filters_returns_only_all_false_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_false'
        ]);
        $filterInstance2 = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_true'
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
    public function any_true_filters_returns_an_empty_array_if_no_any_true_filters(){
        $logic = factory(Logic::class)->create();
        $this->assertIsArray($logic->anyTrueFilters->toArray());
        $this->assertEmpty($logic->anyTrueFilters->toArray());
    }
    /** @test */
    public function any_true_filters_returns_only_any_true_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'any_true'
        ]);
        $filterInstance2 = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_true'
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

    /** @test */
    public function any_false_filters_returns_an_empty_array_if_no_any_false_filters(){
        $logic = factory(Logic::class)->create();
        $this->assertIsArray($logic->anyFalseFilters->toArray());
        $this->assertEmpty($logic->anyFalseFilters->toArray());
    }
    /** @test */
    public function any_false_filters_returns_only_any_false_filters(){
        $logic = factory(Logic::class)->create();
        $filterInstance = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'any_false'
        ]);
        $filterInstance2 = factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_true'
        ]);

        $this->assertCount(1, $logic->anyFalseFilters);
        $this->assertModelEquals($filterInstance, $logic->anyFalseFilters->first());
    }

    /** @test */
    public function filters_can_retrieve_all_filters(){
        $logic = factory(Logic::class)->create();
        $filters = new Collection;
        $filters->push(factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'any_false'
        ]));
        $filters->push(factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_true'
        ]));
        $filters->push(factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'all_false'
        ]));
        $filters->push(factory(FilterInstance::class)->create([
            'logic_id' => $logic->id,
            'logic_type' => 'any_true'
        ]));

        $allFilters = $logic->filters;
        foreach($filters as $filter) {
            $this->assertModelEquals($filter, $allFilters->shift());
        }
    }

}
