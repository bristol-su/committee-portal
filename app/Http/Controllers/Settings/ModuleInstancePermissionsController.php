<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Permissions\ModuleInstancePermissions;
use App\Support\ModuleInstance\ModuleInstance;
use Illuminate\Http\Request;

class ModuleInstancePermissionsController extends Controller
{

    public function store(Request $request, ModuleInstance $moduleInstance)
    {
        // TODO Needs to accept admin and user permissions
        $permissions = new ModuleInstancePermissions(
            ['permissions' => $request->input('permissions')
        ]);
        $permissions->save();
        $moduleInstance->moduleInstancePermissions()->associate($permissions)->save();
        return $permissions;
    }

}
