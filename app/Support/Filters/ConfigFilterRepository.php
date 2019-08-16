<?php


namespace App\Support\Filters;


use App\Support\Filters\Contracts\FilterFactory as FilterFactoryContract;
use App\Support\Filters\Contracts\FilterRepository as FilterRepositoryContract;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

class ConfigFilterRepository implements FilterRepositoryContract
{

    /**
     * @var ConfigRepository
     */
    private $config;
    /**
     * @var FilterFactoryContract
     */
    private $filterFactory;

    public function __construct(ConfigRepository $config, FilterFactoryContract $filterFactory)
    {

        $this->config = $config;
        $this->filterFactory = $filterFactory;
    }

    public function getByAlias($alias)
    {
        $class = $this->config->get('filters.' . $alias);

        return $this->filterFactory->createFilterFromClassName($class);
    }
}
