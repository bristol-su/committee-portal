<?php


namespace App\Http\Controllers\Api;


use App\Support\Filters\FilterInstance;
use Illuminate\Http\Request;

class FilterInstanceController
{

    public function store(Request $request)
    {
        return FilterInstance::create($request->only(['alias', 'name', 'settings']));
    }

}
