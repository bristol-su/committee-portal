<?php

use App\Packages\Permissions\BasePermissionsSeederMigration;

class SeedPermissionsAndRolesNgb extends BasePermissionsSeederMigration
{
    public $permissions = [
        'ngb.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'NGB', 'subgroup' => 'Module'],
        'ngb.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'NGB', 'subgroup' => 'Module'],
        'ngb.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'NGB', 'subgroup' => 'Module'],
        'ngb.submit' => ['description' => 'Allows a user to submit the NGB form', 'title' => 'Submit', 'group' => 'NGB', 'subgroup' => 'Module'],
        'ngb.view' => ['description' => 'Allows a user to view the NGB form', 'title' => 'View', 'group' => 'NGB', 'subgroup' => 'Module'],
        'ngb.view-admin' => ['description' => 'Allows a user to view the admin NGB module', 'title' => 'View Admin', 'group' => 'NGB', 'subgroup' => 'Module'],
        'ngb.reaffiliation.isResponsible' => ['title' => 'Responsible', 'description' => 'Determines if a user is responsible for a module or not', 'group' => 'NGB', 'subgroup' => 'Module'],
    ];
}
