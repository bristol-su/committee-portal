<?php


namespace App\Support\Filters\Contracts;


use App\Support\Filters\Contracts\Filters\Filter;

interface FilterRepository
{

    /**
     * Get a filter instance by alias
     *
     * @param string $alias
     * @return Filter mixed
     */
    public function getByAlias($alias);

}
