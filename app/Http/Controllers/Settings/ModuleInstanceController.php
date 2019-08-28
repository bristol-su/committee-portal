<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Activity\Activity;
use App\Support\ModuleInstance\ModuleInstance;

class ModuleInstanceController extends Controller
{

    public function show(Activity $activity, ModuleInstance $moduleInstance)
    {
        if($moduleInstance->activity_id !== $activity->id) {
            abort(404);
        }
        return view('settings.module_instances.show')->with('moduleInstance', $moduleInstance);
    }

    public function create(Activity $activity)
    {
        return view('settings.module_instances.create')->with(['activity' => $activity]);
    }

}
