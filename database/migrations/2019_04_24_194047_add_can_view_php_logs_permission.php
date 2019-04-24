<?php

use App\Packages\Permissions\BasePermissionsSeederMigration;

class AddCanViewPhpLogsPermission extends BasePermissionsSeederMigration
{

    /**
     * Permissions to create
     *
     * @var array
     */
    public $permissions = [
        'view-php-logs' => ['description' => 'Enable access to viewing PHP logs', 'title' => 'View PHP Logs', 'group' => 'Development', 'subgroup' => 'Logs'],
    ];

}
