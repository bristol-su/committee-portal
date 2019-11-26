<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Activity\Contracts\Repository as ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function index(ActivityRepository $repository)
    {
        $this->authorize('index-activities');
        return view('settings.activity.index')->with([
            'activities' => $repository->all()
        ]);
    }

    public function create()
    {
        $this->authorize('create-activities');
        return view('settings.activity.create');
    }

    public function show(Activity $activity)
    {
        $this->authorize('show-activities');
        return view('settings.activity.show')->with(['activity' => $activity]);
    }

    public function moduleInstances(Activity $activity)
    {
        return $activity->moduleInstances()->with(['moduleInstanceSettings', 'moduleInstancePermissions'])->get();
    }
}
