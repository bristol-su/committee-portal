<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesPoliticalActivity extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'politicalactivity.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Political Activity', 'subgroup' => 'Module'],
        'politicalactivity.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Political Activity', 'subgroup' => 'Module'],
        'politicalactivity.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Political Activity', 'subgroup' => 'Module'],
        'politicalactivity.submit' => ['description' => 'Allows a user to submit the political activity form', 'title' => 'Submit', 'group' => 'Political Activity', 'subgroup' => 'Module'],
        'politicalactivity.view' => ['description' => 'Allows a user to view the political activity form', 'title' => 'View', 'group' => 'Political Activity', 'subgroup' => 'Module'],
        'politicalactivity.view-admin' => ['description' => 'Allows a user to view the admin political activity module', 'title' => 'View Admin', 'group' => 'Political Activity', 'subgroup' => 'Module'],
        'politicalactivity.reaffiliation.isResponsible' => ['title'=> 'Responsible', 'description' => 'Determines if a user is responsible for a module or not', 'group' => 'Political Activity', 'subgroup' => 'Module'],
    ];
}
