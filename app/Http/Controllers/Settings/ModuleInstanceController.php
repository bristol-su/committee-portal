<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ModuleInstance\ModuleInstance;

class ModuleInstanceController extends Controller
{

    public function show(Activity $activity, ModuleInstance $moduleInstance)
    {
        if(!$activity->is($moduleInstance->activity)) {
            abort(404, 'The module instance does not belong to the activity');
        }
        return view('settings.module_instances.show')->with('moduleInstance', $moduleInstance->load(['actionInstances', 'completionConditionInstance']));
    }

    public function create(Activity $activity)
    {
        return view('settings.module_instances.create')->with(['activity' => $activity]);
    }

}
