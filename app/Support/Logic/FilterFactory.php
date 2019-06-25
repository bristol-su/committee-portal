<?php

namespace App\Support\Logic;

use App\Support\Logic\Contracts\Filter;
use App\Support\Logic\Contracts\FilterFactory as FilterFactoryContract;

class FilterFactory implements FilterFactoryContract
{

    public function create(string $filter): Filter
    {
        return resolve($filter);
    }

}