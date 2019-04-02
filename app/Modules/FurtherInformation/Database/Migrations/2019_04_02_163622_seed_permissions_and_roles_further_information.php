<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesFurtherInformation extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'furtherinformation.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Further Information', 'subgroup' => 'Module'],
        'furtherinformation.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Further Information', 'subgroup' => 'Module'],
        'furtherinformation.module.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Further Information', 'subgroup' => 'Module'],
        'furtherinformation.view' => ['description' => 'Allows a user to view the user page', 'title' => 'View', 'group' => 'Further Information', 'subgroup' => 'Module'],
        'furtherinformation.view-admin' => ['description' => 'Allows a user to view the admin page', 'title' => 'View Admin', 'group' => 'Further Information', 'subgroup' => 'Module'],
    ];
}
