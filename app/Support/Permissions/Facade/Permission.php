<?php


namespace App\Support\Permissions\Facade;


use App\Support\Permissions\Contracts\PermissionStore;
use Illuminate\Support\Facades\Facade;

/**
 * Class Permission
 * @method static void register(string $ability, string $name, string $description, string $alias, bool $admin = false) Register a new module permission
 * @method static void registerSitePermission(string $ability, string $name, string $description) Register a new site permission
 * @method static void registerPermission(PermissionContract $permission) Register a new permission
 * @method static PermissionContract get(string $alias) Get a permission by alias
 * @package App\Support\Permissions\Facade
 */
class Permission extends Facade
{

    protected static function getFacadeAccessor()
    {
        return PermissionStore::class;
    }

}
