<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\Permissions\ModuleInstancePermissions;

class ModuleInstancePermissionController extends Controller
{

    public function show(ModuleInstancePermissions $moduleInstancePermissions)
    {
        return $moduleInstancePermissions;
    }

}
