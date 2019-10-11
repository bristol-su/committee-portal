<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Action\ActionInstance;
use BristolSU\Support\Action\ActionInstanceField;
use Illuminate\Http\Request;

class ActionInstanceFieldController extends Controller
{

    public function store(Request $request)
    {
        return ActionInstanceField::create($request->only([
            'event_field', 'action_field', 'action_instance_id'
        ]));
    }

    public function update(ActionInstanceField $actionInstanceField, Request $request)
    {
        $actionInstanceField->fill($request->only([
            'event_field', 'action_field', 'action_instance_id'
        ]));
        $actionInstanceField->save();
        return $actionInstanceField;
    }
}
