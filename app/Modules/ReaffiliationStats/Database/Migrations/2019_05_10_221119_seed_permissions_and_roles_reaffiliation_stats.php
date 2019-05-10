<?php

use App\Packages\Permissions\BasePermissionsSeederMigration;

class SeedPermissionsAndRolesReaffiliationStats extends BasePermissionsSeederMigration
{
    public $permissions = [
        'reaffiliationstats.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Reaffiliation Statistics', 'subgroup' => 'Module'],
        'reaffiliationstats.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Reaffiliation Statistics', 'subgroup' => 'Module'],
        'reaffiliationstats.view-admin' => ['description' => 'Allows a user to view the stats for all groups', 'title' => 'Admin: View Statistics', 'group' => 'Reaffiliation Statistics', 'subgroup' => 'Module'],
    ];
}
