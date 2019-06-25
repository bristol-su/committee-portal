<?php

namespace App\Support\Logic\Contracts;

interface FilterFactory
{

    public function create(string $filter) : Filter;

}