<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BasePermissionAndRoleSeeder extends Seeder
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
    public $roles = [

    ];

    /**
     * Permissions to create
     *
     * @var array
     */
    public $permissions = [

    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $roleName) {
            try {
                Role::findByName($roleName);
            } catch (\Spatie\Permission\Exceptions\RoleDoesNotExist $e) {
                Role::create([
                    'name' => $roleName
                ]);
            }
        }

        foreach ($this->permissions as $permissionName) {

            try {
                Permission::findByName($this->permissionPrefix . $permissionName);
            } catch (\Spatie\Permission\Exceptions\PermissionDoesNotExist $e) {
                Permission::create([
                    'name' => $this->permissionPrefix . $permissionName
                ]);
            }
        }

        foreach ($this->assignments as $role => $permissions) {
            $role = Role::findByName($role);
            foreach ($permissions as $permission) {
                if(!$role->hasPermissionTo($permission)) {
                    $role->permissions()->attach(Permission::findByName($this->permissionPrefix . $permission));
                }
            }
        }
    }
}
