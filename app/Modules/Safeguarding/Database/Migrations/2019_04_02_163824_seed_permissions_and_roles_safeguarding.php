<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesSafeguarding extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'safeguarding.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Safeguarding', 'subgroup' => 'Module'],
        'safeguarding.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Safeguarding', 'subgroup' => 'Module'],
        'safeguarding.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Safeguarding', 'subgroup' => 'Module'],
        'safeguarding.view' => ['description' => 'Allows a user to view the safeguarding page', 'title' => 'View', 'group' => 'Safeguarding', 'subgroup' => 'Module'],
        'safeguarding.view-admin' => ['description' => 'Allows a user to view the admin side of the safeguarding module', 'title' => 'View Admin', 'group' => 'Safeguarding', 'subgroup' => 'Module'],
        'safeguarding.reaffiliation.isResponsible' => ['title'=> 'Responsible', 'description' => 'Determines if a user is responsible for a module or not', 'group' => 'Safeguarding', 'subgroup' => 'Module'],
    ];
}
