<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\ActivityInstance\Contracts\ActivityInstanceRepository;
use Illuminate\Http\Request;

class ActivityInstanceController extends Controller
{

    public function store(Request $request, ActivityInstanceRepository $repository) {
        return $repository->create(
            $request->input('activity_id'),
            $request->input('resource_type'),
            $request->input('resource_id'),
            $request->input('name'),
            $request->input('description')
        );
    }

}
