<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Support\Filters\Contracts\FilterRepository;
use App\Support\Filters\Contracts\Filters\Filter;

class FilterController extends Controller
{

    public function index(FilterRepository $filterRepository)
    {
        return collect($filterRepository->getAll())->map(function(Filter $filter) {
            return $filter->toArray();
        });
    }

}
