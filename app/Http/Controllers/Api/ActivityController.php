<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Support\Activity\Contracts\Repository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function store(Request $request, Repository $repository)
    {
        return $repository->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'activity_for' => $request->input('activity_for'),
            'for_logic' => $request->input('for_logic'),
            'admin_logic' => $request->input('admin_logic'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ]);
    }
}
