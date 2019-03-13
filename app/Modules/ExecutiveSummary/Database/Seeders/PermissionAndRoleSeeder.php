<?php
namespace App\Modules\ExecutiveSummary\Database\Seeders;

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
        'module.isVisible', // Is the module visible?
        'module.isActive', // Is the module active?
        'view',
        'view-admin',
        'upload',
        'download',
        'download-admin',
        'post-note',
        'post-note-admin',
        'change-status',
        'view-note-template-page',
        'delete-note-template',
        'update-note-template',
        'create-note-template',
        'view-note-template',
    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [

    ];

    public $permissionPrefix = 'executivesummary.';

}