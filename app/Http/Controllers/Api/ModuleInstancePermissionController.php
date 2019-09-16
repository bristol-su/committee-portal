<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Permissions\Models\ModuleInstancePermissions;
use Illuminate\Http\Request;

class ModuleInstancePermissionController extends Controller
{

    public function show(ModuleInstancePermissions $moduleInstancePermissions)
    {
        return $moduleInstancePermissions;
    }

    public function store(Request $request)
    {
        return ModuleInstancePermissions::create([
            'participant_permissions' => $request->input('participant_permissions'),
            'admin_permissions' => $request->input('admin_permissions')
        ]);
    }

    public function update(ModuleInstancePermissions $permissions, Request $request)
    {
        $permissions->participant_permissions = $request->input('participant_permissions', $permissions->participant_permissions);
        $permissions->admin_permissions = $request->input('admin_permissions', $permissions->admin_permissions);
        $permissions->save();
        return $permissions;
    }
}
