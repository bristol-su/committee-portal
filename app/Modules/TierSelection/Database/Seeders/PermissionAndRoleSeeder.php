<?php
namespace App\Modules\TierSelection\Database\Seeders;

use App\Modules\BaseModule\Database\Seeders\BasePermissionAndRoleSeeder;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
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
        'module.isActive',
        'module.isVisible',
        'view',
        'view-admin',
        'submit',
    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [

    ];

    public $permissionPrefix = 'tierselection.';
}