<?php


namespace App\Support\Filters;


use App\Support\Filters\Contracts\FilterFactory as FilterFactoryContract;
use Illuminate\Contracts\Container\Container;

class FilterFactory implements FilterFactoryContract
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function createFilterFromClassName($className)
    {
        return $this->container->make($className);
    }
}
