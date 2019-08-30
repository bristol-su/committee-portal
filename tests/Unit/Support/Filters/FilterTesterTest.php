<?php


namespace Tests\Unit\Support\Filters;


use App\Support\Filters\Contracts\FilterInstance;
use App\Support\Filters\Contracts\FilterRepository;
use App\Support\Filters\Contracts\Filters\Filter;
use App\Support\Filters\FilterTester;
use Tests\TestCase;

class FilterTesterTest extends TestCase
{

    /** @test */
    public function it_evaluates_a_filter(){
        $filter = $this->prophesize(Filter::class);
        $filter->hasModel()->shouldBeCalled()->willReturn(true);
        $filter->evaluate(['tag' => 'reference1'])->shouldBeCalled()->willReturn(true);

        $repository = $this->prophesize(FilterRepository::class);
        $repository->getByAlias('alias')->shouldBeCalled()->willReturn($filter->reveal());

        $filterInstance = $this->prophesize(FilterInstance::class);
        $filterInstance->alias()->shouldBeCalled()->willReturn('alias');
        $filterInstance->settings()->shouldBeCalled()->willReturn(['tag' => 'reference1']);

        $filterTester = new FilterTester($repository->reveal());
        $this->assertTrue($filterTester->evaluate($filterInstance->reveal()));
    }

    /** @test */
    public function it_returns_false_if_the_filter_does_not_have_a_model(){
        $filter = $this->prophesize(Filter::class);
        $filter->hasModel()->shouldBeCalled()->willReturn(false);

        $repository = $this->prophesize(FilterRepository::class);
        $repository->getByAlias('alias')->shouldBeCalled()->willReturn($filter->reveal());

        $filterInstance = $this->prophesize(FilterInstance::class);
        $filterInstance->alias()->shouldBeCalled()->willReturn('alias');

        $filterTester = new FilterTester($repository->reveal());
        $this->assertFalse($filterTester->evaluate($filterInstance->reveal()));

    }

}
