<?php


namespace App\Support\Logic\Specification;


use App\Support\Filters\Contracts\FilterInstance;
use App\Support\Filters\Contracts\FilterTester;
use App\Support\Logic\Contracts\Specification;

class FilterFalseSpecification implements Specification
{
    /**
     * @var FilterInstance
     */
    private $filter;
    /**
     * @var FilterTester
     */
    private $filterTester;

    public function __construct(FilterInstance $filter, FilterTester $filterTester)
    {
        $this->filter = $filter;
        $this->filterTester = $filterTester;
    }

    public function isSatisfied(): bool
    {
        return $this->filterTester->evaluate($this->filter) === false;
    }

}
