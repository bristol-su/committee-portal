<?php

namespace Tests\Unit\Support\Logic\Specification;

use App\Support\Filters\Contracts\FilterInstance;
use App\Support\Filters\Contracts\FilterTester;
use App\Support\Logic\Specification\FilterFalseSpecification;
use Tests\TestCase;

class FilterFalseSpecificationTest extends TestCase
{

    /** @test */
    public function it_returns_true_if_the_filter_is_false(){
        $filter = $this->prophesize(FilterInstance::class);
        $filterTester = $this->prophesize(FilterTester::class);
        $filterTester->evaluate($filter->reveal())->shouldBeCalled()->willReturn(false);

        $spec = new FilterFalseSpecification($filter->reveal(), $filterTester->reveal());

        $this->assertTrue(
            $spec->isSatisfied()
        );
    }

    /** @test */
    public function it_returns_false_if_the_filter_is_true(){
        $filter = $this->prophesize(FilterInstance::class);
        $filterTester = $this->prophesize(FilterTester::class);
        $filterTester->evaluate($filter->reveal())->shouldBeCalled()->willReturn(true);

        $spec = new FilterFalseSpecification($filter->reveal(), $filterTester->reveal());

        $this->assertFalse(
            $spec->isSatisfied()
        );
    }

}
