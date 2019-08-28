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

    }

    /** @test */
    public function get_all_returns_all_filters_by_alias(){

    }

    /** @test */
    public function get_all_returns_an_empty_array_if_no_filters_found(){

    }

}
