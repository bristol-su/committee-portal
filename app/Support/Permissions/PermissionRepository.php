<?php


namespace App\Support\Permissions;


use App\Support\Permissions\Contracts\Models\Permission;
use App\Support\Permissions\Contracts\PermissionRepository as PermissionRepositoryContract;
use App\Support\Permissions\Contracts\PermissionStore as PermissionStoreContract;

class PermissionRepository implements PermissionRepositoryContract
{

    /**
     * @var PermissionStoreContract
     */
    private $permissionStore;

    public function __construct(PermissionStoreContract $permissionStore)
    {
        $this->permissionStore = $permissionStore;
    }

    public function get(string $ability): Permission
    {
        return $this->permissionStore->get($ability);
    }

    public function forModule(string $alias): array
    {
        return collect($this->permissionStore->all())->filter(function(Permission $permission) use ($alias) {
            return $permission->getModuleAlias() === $alias;
        })->values()->toArray();
    }
}
