<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesGDPR extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'gdpr.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'GDPR', 'subgroup' => 'Module'],
        'gdpr.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'GDPR', 'subgroup' => 'Module'],
        'gdpr.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'GDPR', 'subgroup' => 'Module'],
        'gdpr.submit' => ['description' => 'Allows a user to submit the GDPR form', 'title' => 'Submit', 'group' => 'GDPR', 'subgroup' => 'Module'],
        'gdpr.view' => ['description' => 'Allows a user to view the GDPR form', 'title' => 'View', 'group' => 'GDPR', 'subgroup' => 'Module'],
        'gdpr.view-admin' => ['description' => 'Allows a user to view the admin GDPR module', 'title' => 'View Admin', 'group' => 'GDPR', 'subgroup' => 'Module'],
        'gdpr.reaffiliation.isResponsible' => ['title'=> 'Responsible', 'description' => 'Determines if a user is responsible for a module or not', 'group' => 'GDPR', 'subgroup' => 'Module'],
    ];
}
