<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesMainContacts extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'maincontacts.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Main Contacts', 'subgroup' => 'Module'],
        'maincontacts.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Main Contacts', 'subgroup' => 'Module'],
        'maincontacts.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Main Contacts', 'subgroup' => 'Module'],
        'maincontacts.submit' => ['description' => 'Allows a user to submit the main contacts form', 'title' => 'Submit', 'group' => 'Main Contacts', 'subgroup' => 'Module'],
        'maincontacts.view' => ['description' => 'Allows a user to view the main contacts form ', 'title' => 'View', 'group' => 'Main Contacts', 'subgroup' => 'Module'],
        'maincontacts.view-admin' => ['description' => 'Allows a user to view the admin side of the main contacts form', 'title' => 'View Admin', 'group' => 'Main Contacts', 'subgroup' => 'Module'],
    ];
}
