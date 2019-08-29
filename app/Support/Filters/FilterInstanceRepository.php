<?php


namespace App\Support\Filters;


use App\Support\Filters\Contracts\FilterInstanceRepository as FilterInstanceRepositoryContract;

class FilterInstanceRepository implements FilterInstanceRepositoryContract
{
    public function create($attributes = [])
    {
        return FilterInstance::create($attributes);
    }
}
