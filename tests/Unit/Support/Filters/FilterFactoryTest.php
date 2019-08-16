<?php


namespace Tests\Unit\Support\Filters;


use App\Support\Filters\Contracts\Filters\Filter;
use App\Support\Filters\FilterFactory;
use Illuminate\Contracts\Container\Container;
use Tests\TestCase;

class FilterFactoryTest extends TestCase
{

    /** @test */
    public function it_creates_a_filter_from_the_container(){
        $container = $this->prophesize(Container::class);
        $filter = $this->prophesize(Filter::class);
        $container->make('ClassName')->shouldBeCalled()->willReturn($filter->reveal());

        $filterFactory = new FilterFactory($container->reveal());
        $createdFilter = $filterFactory->createFilterFromClassName('ClassName');

        $this->assertInstanceOf(Filter::class, $createdFilter);
        $this->assertEquals($filter->reveal(), $createdFilter);
    }

}
