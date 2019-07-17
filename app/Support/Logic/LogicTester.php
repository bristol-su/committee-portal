<?php

namespace App\Support\Logic;

use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
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
     * @var FilterFactoryContract
     */
    private $filterFactory;
    /**
     * @var AuthenticationModelFactoryContract
     */
    private $authenticationModelFactory;

    public function __construct(FilterFactoryContract $filterFactory, AuthenticationModelFactoryContract $authenticationModelFactory)
    {
        $this->filterFactory = $filterFactory;
        $this->authenticationModelFactory = $authenticationModelFactory;
    }

    public function evaluate(Logic $logic)
    {
        $allTrue = [];
        $anyTrue = [];
        $allFalse = [];
        $anyFalse = [];

        foreach($logic->all_true as $filterInformation) {
            $filter = $this->filterFactory->create($filterInformation['class']);
            $model = $this->authenticationModelFactory->createFromString($filter->validFor());
            $allTrue[] = new FilterTrueSpecification($filter, $model, $filterInformation['setting']);
        }

        foreach($logic->any_true as $filterInformation) {
            $filter = $this->filterFactory->create($filterInformation['class']);
            $model = $this->authenticationModelFactory->createFromString($filter->validFor());
            $anyTrue[] = new FilterTrueSpecification($filter, $model, $filterInformation['setting']);
        }

        foreach($logic->all_false as $filterInformation) {
            $filter = $this->filterFactory->create($filterInformation['class']);
            $model = $this->authenticationModelFactory->createFromString($filter->validFor());
            $allFalse[] = new FilterFalseSpecification($filter, $model, $filterInformation['setting']);
        }

        foreach($logic->any_false as $filterInformation) {
            $filter = $this->filterFactory->create($filterInformation['class']);
            $model = $this->authenticationModelFactory->createFromString($filter->validFor());
            $anyFalse[] = new FilterFalseSpecification($filter, $model, $filterInformation['setting']);
        }


        return (new AndSpecification(
            new AndSpecification(...$allTrue),
            new OrSpecification(...$anyTrue),
            new AndSpecification(...$allFalse),
            new OrSpecification(...$anyFalse)
        ))->isSatisfied();



    }

}