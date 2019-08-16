<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    public function index()
    {
        return view('settings.settings');
    }

}
