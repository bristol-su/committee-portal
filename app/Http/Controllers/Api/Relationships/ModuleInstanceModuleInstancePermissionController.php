<?php

namespace App\Http\Controllers\Api\Relationships;

use App\Http\Controllers\Controller;
use BristolSU\Support\ModuleInstance\ModuleInstance;

class ModuleInstanceModuleInstancePermissionController extends Controller
{

    public function index(ModuleInstance $moduleInstance)
    {
        return $moduleInstance->moduleInstancePermissions;
    }

}
