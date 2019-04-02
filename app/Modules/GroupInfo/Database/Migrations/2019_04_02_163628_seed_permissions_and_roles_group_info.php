<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesGroupInfo extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'groupinfo.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Group Info', 'subgroup' => 'Module'],
        'groupinfo.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Group Info', 'subgroup' => 'Module'],
        'groupinfo.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Group Info', 'subgroup' => 'Module'],
        'groupinfo.submit' => ['description' => 'Allows a user to submit the group info form', 'title' => 'Submit', 'group' => 'Group Info', 'subgroup' => 'Module'],
        'groupinfo.view' => ['description' => 'Allows a user to view the group information', 'title' => 'View', 'group' => 'Group Info', 'subgroup' => 'Module'],
        'groupinfo.view-admin' => ['description' => 'Allows a user to view the admin group information page', 'title' => 'View Admin', 'group' => 'Group Info', 'subgroup' => 'Module'],
    ];
}
