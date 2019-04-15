<?php

namespace App\Packages\Permissions;

use Exception;
use Illuminate\Database\Migrations\Migration;

class BasePermissionsSeederMigration extends Migration
{

    /**
     * Optional prefix for the start of the permission name
     * @var null
     */
    public $permissionPrefix = '';

    /**
     * Roles to create
     *
     * @var array
     */
    public $roles = [];

    /**
     * Permissions to create
     *
     * @var array
     */
    public $permissions = [];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [];

    public function up()
    {
        foreach ($this->roles as $roleName) {
            Role::create([
                'name' => $roleName
            ]);
        }

        foreach ($this->permissions as $permissionName => $meta) {
            if (!is_array($meta)) {
                throw new Exception($meta . ' had no meta data.');
            };
            Permission::create([
                'name' => $this->permissionPrefix . $permissionName,
                'title' => $meta['title'],
                'description' => $meta['description'],
                'group' => $meta['group'],
                'subgroup' => $meta['subgroup']
            ]);
        }

        foreach ($this->assignments as $role => $permissions) {
            $role = Role::findByName($role);
            foreach ($permissions as $permission) {
                if (!$role->hasPermissionTo($permission)) {
                    $role->permissions()->attach(Permission::findByName($this->permissionPrefix . $permission));
                }
            }
        }
    }

    public function down()
    {
        foreach ($this->roles as $roleName) {
            Role::findByName($roleName)->forceDelete();
        }

        foreach ($this->permissions as $permissionName => $meta) {
            if (!is_array($meta)) {
                throw new Exception($meta . ' had no meta data.');
            };
            Permission::findByName($this->permissionPrefix . $permissionName)->forceDelete();
        }

    }

}