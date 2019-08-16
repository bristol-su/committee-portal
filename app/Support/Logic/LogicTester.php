<?php

namespace App\Support\Logic;

use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Filters\Contracts\FilterTester;
use App\Support\Logic\Contracts\AuthenticationModelFactory as AuthenticationModelFactoryContract;
use App\Support\Logic\Contracts\Filter as FilterContract;
use App\Support\Logic\Contracts\FilterFactory as FilterFactoryContract;
use App\Support\Logic\Contracts\LogicTester as LogicTesterContract;
use App\Support\Logic\Specification\AndSpecification;
use App\Support\Logic\Specification\OrSpecification;
use App\Support\Logic\Specification\FilterFalseSpecification;
use App\Support\Logic\Specification\FilterTrueSpecification;

class LogicTester implements LogicTesterContract
{

    /**
     * @var FilterTester
     */
    private $filterTester;

    public function __construct(FilterTester $filterTester)
    {
        $this->filterTester = $filterTester;
    }

    public function evaluate(Logic $logic)
    {
        $allTrue = [];
        $anyTrue = [];
        $allFalse = [];
        $anyFalse = [];

        foreach($logic->allTrueFilters as $filter) {
            $allTrue[] = new FilterTrueSpecification($filter, $this->filterTester);
        }

        foreach($logic->anyTrueFilters as $filter) {
            $anyTrue[] = new FilterTrueSpecification($filter, $this->filterTester);
        }

        foreach($logic->allFalseFilters as $filter) {
            $allFalse[] = new FilterFalseSpecification($filter, $this->filterTester);
        }

        foreach($logic->anyFalseFilters as $filter) {
            $anyFalse[] = new FilterFalseSpecification($filter, $this->filterTester);
        }


        return (new AndSpecification(
            new AndSpecification(...$allTrue),
            new OrSpecification(...$anyTrue),
            new AndSpecification(...$allFalse),
            new OrSpecification(...$anyFalse)
        ))->isSatisfied();
    }

}
