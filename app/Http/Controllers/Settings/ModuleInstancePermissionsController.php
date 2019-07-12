<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Module\Module\Permissions\ModuleInstancePermissions;
use App\Support\Module\ModuleInstance\ModuleInstance;
use Illuminate\Http\Request;

class ModuleInstancePermissionsController extends Controller
{

    public function store(Request $request, ModuleInstance $moduleInstance)
    {
        $permissions = new ModuleInstancePermissions(
            ['permissions' => $request->input('permissions')
        ]);
        $permissions->save();
        $moduleInstance->moduleInstancePermissions()->associate($permissions)->save();
        return $permissions;
    }

}
