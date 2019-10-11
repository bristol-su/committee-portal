<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Action\ActionInstance;
use Illuminate\Http\Request;

class ActionInstanceController extends Controller
{

    public function store(Request $request)
    {
        return ActionInstance::create($request->only([
            'name', 'description', 'event', 'action', 'module_instance_id'
        ]));
    }

    public function update(ActionInstance $actionInstance, Request $request)
    {
        $actionInstance->fill($request->only([
            'name', 'description', 'event', 'action', 'module_instance_id'
        ]));
        $actionInstance->save();
        return $actionInstance;
    }

    public function show(ActionInstance $actionInstance)
    {
        dd($actionInstance);
    }
}
