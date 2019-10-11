<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use BristolSU\Support\Action\ActionInstance;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ModuleInstance\ModuleInstance;

class ActionController extends Controller
{

    public function show(Activity $activity, ModuleInstance $moduleInstance, ActionInstance $actionInstance)
    {
        return view('settings.actions.show')->with('action', $actionInstance);
    }

    public function create(Activity $activity, ModuleInstance $moduleInstance)
    {
        return view('settings.actions.create')->with('moduleInstance', $moduleInstance);
    }

}
