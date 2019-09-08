<?php


namespace App\Support\Permissions;


use App\Support\Permissions\Contracts\Models\Permission;
use App\Support\Permissions\Contracts\PermissionStore as PermissionStoreContract;

class PermissionStore implements PermissionStoreContract
{

    private $permissions = [];

    public function registerSitePermission(string $ability, string $name, string $description): void
    {
        $permission = resolve(Permission::class, [
            'ability' => $ability,
            'name' => $name,
            'description' => $description,
            'type' => 'global'
        ]);
        $this->registerPermission($permission);
    }

    public function registerPermission(Permission $permission): void
    {
        $this->permissions[$permission->getAbility()] = $permission;
    }

    public function registerModulePermission(string $ability, string $name, string $description, string $alias, bool $admin = false): void
    {
        $permission = resolve(Permission::class, [
            'ability' => $ability,
            'name' => $name,
            'description' => $description,
            'type' => 'module',
            'alias' => $alias,
            'moduleType' => ($admin?'administrator':'participant')
        ]);
        $this->registerPermission($permission);
    }

    public function register(string $ability, string $name, string $description, string $alias, bool $admin = false): void
    {
        $this->registerModulePermission($ability, $name, $description, $alias, $admin);
    }

    public function get(string $ability): Permission
    {
        if(array_key_exists($ability, $this->permissions)) {
            return $this->permissions[$ability];
        }
        throw new \Exception('Permission ' . $ability . ' not registered');
    }

    public function all(): array
    {
        return $this->permissions;
    }
}
