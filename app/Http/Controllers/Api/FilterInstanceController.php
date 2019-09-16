<?php


namespace App\Http\Controllers\Api;


use BristolSU\Support\Filters\Contracts\FilterInstanceRepository;
use BristolSU\Support\Filters\FilterInstance;
use Illuminate\Http\Request;

class FilterInstanceController
{

    public function store(Request $request, FilterInstanceRepository $repository)
    {
        return $repository->create($request->only(['alias', 'name', 'settings']));
    }

}
