<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\Module\Module\Module;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Illuminate\Http\Request;

class ModuleInstanceSettingController extends Controller
{

    public function show(ModuleInstanceSettings $moduleInstanceSettings)
    {
        return $moduleInstanceSettings;
    }

    public function store(Request $request)
    {
        return ModuleInstanceSettings::create([
            'settings' => $request->input('settings')
        ]);
    }

    public function update(ModuleInstanceSettings $settings, Request $request)
    {
        $settings->settings = $request->input('settings', $settings->settings);
        $settings->save();
        return $settings;
    }
}
