<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Activity\Activity;
use App\Support\Activity\Contracts\Repository as ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function index(ActivityRepository $repository)
    {
        return view('settings.activity.index')->with([
            'activities' => $repository->all()
        ]);
    }

    public function create()
    {
        return view('settings.activity.create');
    }

    public function show(Activity $activity)
    {
        return view('settings.activity.show')->with(['activity' => $activity]);
    }

    public function moduleInstances(Activity $activity)
    {
        return $activity->moduleInstances()->with(['moduleInstanceSettings', 'moduleInstancePermissions'])->get();
    }
}
