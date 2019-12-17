<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Permissions\Models\ModuleInstancePermission;
use Illuminate\Http\Request;

class ModuleInstancePermissionController extends Controller
{

    public function show(ModuleInstancePermission $moduleInstancePermission)
    {
        return $moduleInstancePermission;
    }

    public function store(Request $request)
    {
        return ModuleInstancePermission::create([
            'logic_id' => $request->input('logic_id'),
            'ability' => $request->input('ability'),
            'module_instance_id' => $request->input('module_instance_id')
        ]);
    }

    public function update(ModuleInstancePermission $permission, Request $request)
    {
        $permission->fill([
            'logic_id' => $request->input('logic_id', $permission->logic_id),
        ]);
        $permission->save();
        return $permission;
    }
}
