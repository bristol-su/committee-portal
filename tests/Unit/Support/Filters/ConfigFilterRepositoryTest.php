<?php


namespace Tests\Unit\Support\Filters;


use App\Support\Filters\ConfigFilterRepository;
use App\Support\Filters\Contracts\FilterFactory;
use App\Support\Filters\Contracts\Filters\Filter;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Tests\TestCase;

class ConfigFilterRepositoryTest extends TestCase
{

    /** @test */
    public function get_by_alias_gets_a_filter_by_alias(){
        $config = $this->prophesize(ConfigRepository::class);
        $config->get('filters.alias')->shouldBeCalled()->willReturn('FilterClassName');

        $filter = $this->prophesize(Filter::class);
        $factory = $this->prophesize(FilterFactory::class);
        $factory->createFilterFromClassName('FilterClassName')->shouldBeCalled()->willReturn($filter->reveal());

        $repository = new ConfigFilterRepository($config->reveal(), $factory->reveal());
        $this->assertEquals($filter->reveal(), $repository->getByAlias('alias'));
    }

    /** @test */
    public function get_by_alias_throws_an_exception_if_filter_not_found(){
        $this->expectException(\Exception::class);

        $config = $this->prophesize(ConfigRepository::class);
        $config->get('filters.nonexistent')->shouldBeCalled()->willReturn(null);
        $factory = $this->prophesize(FilterFactory::class);

        $repository = new ConfigFilterRepository($config->reveal(), $factory->reveal());
        $repository->getByAlias('nonexistent');
    }

    /** @test */
    public function get_all_returns_all_filters_by_alias(){
        $filterAlias = [
            'Class1',
            'Class2',
            'Class3',
            'Class4'
        ];

        $config = $this->prophesize(ConfigRepository::class);
        $config->get('filters')->shouldBeCalled()->willReturn($filterAlias);

        $factory = $this->prophesize(FilterFactory::class);
        foreach($filterAlias as $alias) {
            $factory->createFilterFromClassName($alias)->shouldBeCalled()->willReturn($alias);
        }

        $repository = new ConfigFilterRepository($config->reveal(), $factory->reveal());
        $this->assertEquals($filterAlias, $repository->getAll());
    }

    /** @test */
    public function get_all_returns_an_empty_array_if_no_filters_found(){
        $config = $this->prophesize(ConfigRepository::class);
        $config->get('filters')->shouldBeCalled()->willReturn([]);

        $factory = $this->prophesize(FilterFactory::class);

        $repository = new ConfigFilterRepository($config->reveal(), $factory->reveal());
        $this->assertEquals([], $repository->getAll());
    }

}
