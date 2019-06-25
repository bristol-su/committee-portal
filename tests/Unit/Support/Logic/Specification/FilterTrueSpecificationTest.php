<?php


namespace Tests\Unit\Support\Logic\Specification;


use App\Support\Control\Models\Contracts\Group as GroupContract;
use App\Support\Logic\Contracts\Filter as FilterContract;
use App\Support\Logic\Specification\FilterTrueSpecification;
use Tests\TestCase;

class FilterTrueSpecificationTest extends TestCase
{

    /** @test */
    public function it_returns_true_if_the_filter_is_true(){
        $filter = $this->prophesize(FilterContract::class);
        $model = $this->prophesize(GroupContract::class);
        $filter->evaluate($model->reveal(), 'setting')->shouldBeCalled()->willReturn(true);

        $filterSpecification = new FilterTrueSpecification($filter->reveal(), $model->reveal(), 'setting');
        $this->assertTrue($filterSpecification->isSatisfied());
    }

    /** @test */
    public function it_returns_false_if_the_filter_is_false(){
        $filter = $this->prophesize(FilterContract::class);
        $model = $this->prophesize(GroupContract::class);
        $filter->evaluate($model->reveal(), 'setting')->shouldBeCalled()->willReturn(false);

        $filterSpecification = new FilterTrueSpecification($filter->reveal(), $model->reveal(), 'setting');
        $this->assertFalse($filterSpecification->isSatisfied());
    }

}