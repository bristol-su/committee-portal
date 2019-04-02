<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesTierSelection extends \App\Packages\Permissions\BasePermissionsSeederMigration
{

    public $permissions = [
        'tierselection.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Tier Selection', 'subgroup' => 'Module'],
        'tierselection.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Tier Selection', 'subgroup' => 'Module'],
        'tierselection.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Tier Selection', 'subgroup' => 'Module'],
        'tierselection.submit' => ['description' => 'Allows a user to confirm the tier selection', 'title' => 'Submit', 'group' => 'Tier Selection', 'subgroup' => 'Module'],
        'tierselection.view' => ['description' => 'Allows a user to view the tier selection page', 'title' => 'View', 'group' => 'Tier Selection', 'subgroup' => 'Module'],
        'tierselection.view-admin' => ['description' => 'Allows a user to view the admin tier selection page', 'title' => 'View Admin', 'group' => 'Tier Selection', 'subgroup' => 'Module'],
    ];
}
