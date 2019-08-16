<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\Module\Settings\ModuleInstanceSettings;

class ModuleInstanceSettingController extends Controller
{

    public function show(ModuleInstanceSettings $moduleInstanceSettings)
    {
        return $moduleInstanceSettings;
    }

}
