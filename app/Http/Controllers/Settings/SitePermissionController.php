<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use BristolSU\Support\Permissions\Models\Permission;

class SitePermissionController extends Controller
{

    public function index()
    {
        return view('settings.sitepermissions.index');
    }

    public function show(Permission $permission)
    {
        return view('settings.sitepermissions.show')->with('permission', $permission);
    }

}
