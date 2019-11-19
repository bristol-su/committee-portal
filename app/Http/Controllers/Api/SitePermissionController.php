<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use BristolSU\Support\Permissions\Contracts\Models\Permission;
use BristolSU\Support\Permissions\Contracts\PermissionRepository;
use BristolSU\Support\Permissions\Models\Permission as PermissionModel;

class SitePermissionController extends Controller
{

    /**
     * Get all permissions registered
     *
     * @param PermissionRepository $permissionRepository
     * @return array
     */
    public function index(PermissionRepository $permissionRepository)
    {
        return collect($permissionRepository->all())->filter(function(Permission $permission) {
            return $permission->getType() === 'global';
        });
    }


    public function show(PermissionModel $permission)
    {
        return $permission;
    }

}
