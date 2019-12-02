<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;

class ActivityProgressController extends Controller
{

    public function index(Activity $activity)
    {
        return view('progress.activity_progress')->with([
            'activity' => $activity
        ]);
    }

}
