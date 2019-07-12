<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Module\ModuleInstance\ModuleInstance;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Illuminate\Http\Request;

class ModuleInstanceSettingsController extends Controller
{

    public function store(Request $request, ModuleInstance $moduleInstance)
    {
        $settings = new ModuleInstanceSettings(
            ['settings' => $request->input('settings')
        ]);
        $settings->save();
        $moduleInstance->moduleInstanceSettings()->associate($settings)->save();
        return $settings;
    }

}
