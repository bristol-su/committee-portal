<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{

    /**
     * Roles to create
     *
     * @var array
     */
    public $roles = [
        'admin' // Allow the user to do the bare minimum adminstration
    ];

    /**
     * Permissions to create
     *
     * @var array
     */
    public $permissions = [
        'act-as-admin', // Allows the user to be seen as an administrator
        'view-as-student', // Allow the user to view the portal as a specific student
        'bypass-maintenance', // Pass the maintenance middleware for modules
        'act-as-super-admin', // Pass every gate check
        'view-site-settings-page', // Able to see the 'settings' page on admin
        'settings.see-all-admin-users', // See all the admin users listed out.
        'settings.see-manage-admin-permissions', // See all the roles and permissions and enter manage user permissions page
        'settings.update-admin-permissions', // Able to update admin permissions
    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [
        'admin' => [
            'act-as-admin'
        ]
    ];

}
