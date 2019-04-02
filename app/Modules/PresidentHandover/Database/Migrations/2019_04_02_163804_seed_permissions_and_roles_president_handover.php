<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesPresidentHandover extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'presidenthandover.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'President Handover', 'subgroup' => 'Module'],
        'presidenthandover.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'President Handover', 'subgroup' => 'Module'],
        'presidenthandover.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'President Handover', 'subgroup' => 'Module'],
        'presidenthandover.submit' => ['description' => 'Allows a user to give a new initital president', 'title' => 'Submit', 'group' => 'President Handover', 'subgroup' => 'Module'],
        'presidenthandover.view' => ['description' => 'Allows a user to view the president handover form', 'title' => 'View', 'group' => 'President Handover', 'subgroup' => 'Module'],
        'presidenthandover.view-admin' => ['description' => 'Allows a user to view the admin side of the president handover', 'title' => 'View Admin', 'group' => 'President Handover', 'subgroup' => 'Module'],
    ];
}
