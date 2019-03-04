<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BasePermissionAndRoleSeeder extends Seeder
{

    /**
     * Roles to create
     *
     * @var array
     */
    protected $roles = [

    ];

    /**
     * Permissions to create
     *
     * @var array
     */
    protected $permissions = [

    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    protected $assignments = [

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->roles as $roleName) {
            $role = new Role([
                'name' => $roleName
            ]);
            $role->save();
        }

        foreach($this->permissions as $permissionName) {
            $permission = new Permission([
                'name' => $permissionName
            ]);
            $permission->save();
        }

        foreach($this->assignments as $role => $permissions)
        {
            $role = Role::findByName($role);
            foreach($permissions as $permission) {
                $role->permissions()->attach(Permission::findByName($permission));
            }
        }
    }
}
