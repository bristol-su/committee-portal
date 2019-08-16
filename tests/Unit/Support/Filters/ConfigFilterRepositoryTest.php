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
    public function it_retrieves_the_class_name_from_configuration_and_passes_it_to_a_factory(){
        $config = $this->prophesize(ConfigRepository::class);
        $config->get('filters.alias')->shouldBeCalled()->willReturn('FilterClassName');

        $filter = $this->prophesize(Filter::class);
        $factory = $this->prophesize(FilterFactory::class);
        $factory->createFilterFromClassName('FilterClassName')->shouldBeCalled()->willReturn($filter->reveal());

        $repository = new ConfigFilterRepository($config->reveal(), $factory->reveal());
        $this->assertEquals($filter->reveal(), $repository->getByAlias('alias'));
    }

}
