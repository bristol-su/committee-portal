<?php

use App\Packages\Permissions\BasePermissionsSeederMigration;

class SeedPermissionsAndRoles extends BasePermissionsSeederMigration
{
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
        'settings.create-admin-user' => ['description' => 'Allows a user to create an admin user', 'title' => 'Create Admin User', 'group' => 'Settings', 'subgroup' => 'User'],
        'settings.create-role' => ['description' => 'Allows a user to create a role', 'title' => 'Create a Role', 'group' => 'Settings', 'subgroup' => 'Role'],
        'settings.delete-admin-user' => ['description' => 'Allows a user to delete an admin user', 'title' => 'Delete Admin User', 'group' => 'Settings', 'subgroup' => 'User'],
        'settings.delete-role' => ['description' => 'Allows a user to delete a role', 'title' => 'Delete Role', 'group' => 'Settings', 'subgroup' => 'Role'],
        'settings.delete-user' => ['description' => 'Allows a user to delete site users', 'title' => 'Delete Users', 'group' => 'Settings', 'subgroup' => 'User'],
        'settings.see-all-users' => ['description' => 'Allows a user to see all site users', 'title' => 'See all Users', 'group' => 'Settings', 'subgroup' => 'User'],
        'settings.see-roles-and-permissions' => ['description' => 'Allows a user to see all roles and permissions available. This permission is needed alongside updating roles for users.', 'title' => 'See all roles and permissions', 'group' => 'Settings', 'subgroup' => 'Roles'],
        'settings.update-admin-permissions' => ['description' => 'Allows a user to update the roles of a user', 'title' => 'Update User Roles and Permissions', 'group' => 'Settings', 'subgroup' => 'Users'],
        'settings.update-admin-user' => ['description' => 'Allows a user to update an admin user (i.e. the name, email address and Student ID)', 'title' => 'Update Admin User', 'group' => 'Settings', 'subgroup' => 'User'],
        'settings.update-role' => ['description' => 'Allows a user to update a role', 'title' => 'Update a Role', 'group' => 'Settings', 'subgroup' => 'Role'],
        'settings.update-role-permissions' => ['description' => 'Allows a user to update permisisons assigned to a role', 'title' => 'Update Role Permissions', 'group' => 'Settings', 'subgroup' => 'Role'],
        'settings.update-user' => ['description' => 'Allows a user to update a user (i.e. the name, email address and student ID)', 'title' => 'Update User', 'group' => 'Settings', 'subgroup' => 'User'],
        'view-site-settings-page' => ['description' => 'Allows a user to view the site settings page. Module setting permissions are controlled by their own permission sets.', 'title' => 'View Site Settings', 'group' => 'Settings', 'subgroup' => ''],
        'act-as-admin' => ['description' => 'Allows a user to view the admin dashboard.', 'title' => 'Act as Admin', 'group' => 'Site', 'subgroup' => ''],
        'act-as-super-admin' => ['description' => 'Allows a user to do anything on the site.', 'title' => 'Act as Super Admin', 'group' => 'Site', 'subgroup' => ''],
        'bypass-maintenance' => ['description' => 'Allow the user to bypass maintenance filters on modules.', 'title' => 'Bypass Maintenance', 'group' => 'Site', 'subgroup' => ''],
        'view-as-student' => ['description' => 'Allows a user to view a student group portal.', 'title' => 'View as Student', 'group' => 'Site', 'subgroup' => 'View as Student'],
        'view-as-student-society' => ['description' => 'Allows a user to view the portal for a society', 'title' => 'View as Student: Society', 'group' => 'Site', 'subgroup' => 'View as Student'],
        'view-as-student-volunteering' => ['description' => 'Allows a user to view the portal for a volunteer project', 'title' => 'View as Student: Volunteering Project', 'group' => 'Site', 'subgroup' => 'View as Student'],
        'view-as-student-sports' => ['description' => 'Allows a user to view the portal for a sports club', 'title' => 'View as Student: Sport', 'group' => 'Site', 'subgroup' => 'View as Student'],

    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [];
}
