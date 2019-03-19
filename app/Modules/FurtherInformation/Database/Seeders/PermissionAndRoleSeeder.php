<?php
namespace App\Modules\FurtherInformation\Database\Seeders;

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
        'module.isVisible' => [// TODO Shouldn't affect both sides
            'title' => '#WABFurtherInformation: Visibility of module',
            'description' => 'Is the module visible? This will effect both the admin and user side.'
        ],
        'module.isActive' => [
            'title' => '#WABFurtherInformation: Is the module enabled?',
            'description' => 'Is the module enabled? If so, the module can be opened.'
        ],
        'view' => [
            'title' => '#WABFurtherInformation: Viewable',
            'description' => 'Can the module page be opened?'
        ],
        'view-admin' => [
            'title' => '#WABFurtherInformation: Viewable Admin',
            'description' => 'Can the admin module page be opened?'
        ],

    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [

    ];

    public $permissionPrefix = 'furtherinformation.';
}