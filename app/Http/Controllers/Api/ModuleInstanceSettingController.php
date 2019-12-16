<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Module\Module;
use BristolSU\Support\ModuleInstance\Settings\ModuleInstanceSetting;
use Illuminate\Http\Request;

class ModuleInstanceSettingController extends Controller
{

    public function show(ModuleInstanceSetting $moduleInstanceSetting)
    {
        return $moduleInstanceSetting;
    }

    public function store(Request $request)
    {
        return ModuleInstanceSetting::create([
            'key' => $request->input('key'),
            'value' => $request->input('value'),
            'module_instance_id' => $request->input('module_instance_id')
        ]);
    }

    public function update(ModuleInstanceSetting $setting, Request $request)
    {
        $setting->fill([
            'value' => $request->input('value', $setting->value),
        ]);
        $setting->save();
        return $setting;
    }
}
