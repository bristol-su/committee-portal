<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Support\Activity\Contracts\Repository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function store(Request $request, Repository $repository)
    {
        return $repository->create($request->only([
            'name', 'description', 'slug', 'for_logic', 'admin_logic', 'start_date', 'end_date'
        ]));
    }
}
