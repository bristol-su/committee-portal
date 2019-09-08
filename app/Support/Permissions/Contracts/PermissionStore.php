<?php


namespace App\Support\Permissions\Contracts;


use App\Support\Permissions\Contracts\Models\Permission;

interface PermissionStore
{
    /**
     * Register a global site permission
     *
     * @param string $ability
     * @param string $name
     * @param string $description
     */
    public function registerSitePermission(string $ability, string $name, string $description): void;

    /**
     * Register a module permission
     *
     * @param string $ability
     * @param string $name
     * @param string $description
     * @param string $alias
     * @param bool $admin
     */
    public function register(string $ability, string $name, string $description, string $alias, bool $admin = false): void;


    /**
     * Register a module permission
     *
     * @param string $ability
     * @param string $name
     * @param string $description
     * @param string $alias
     * @param bool $admin
     */
    public function registerModulePermission(string $ability, string $name, string $description, string $alias, bool $admin = false): void;


    /**
     * Register a permission class
     *
     * @param Permission $permission
     */
    public function registerPermission(Permission $permission): void;

    public function get(string $ability): Permission;

    public function all(): array;

}
