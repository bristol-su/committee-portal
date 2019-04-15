<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesTaskAllocation extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'taskallocation.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Task Allocation', 'subgroup' => 'Module'],
        'taskallocation.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Task Allocation', 'subgroup' => 'Module'],
        'taskallocation.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Task Allocation', 'subgroup' => 'Module'],
        'taskallocation.submit' => ['description' => 'Allows a user to submit the task allocation form', 'title' => 'Submit', 'group' => 'Task Allocation', 'subgroup' => 'Module'],
        'taskallocation.view' => ['description' => 'Allows a user to view the task allocation page', 'title' => 'View', 'group' => 'Task Allocation', 'subgroup' => 'Module'],
        'taskallocation.view-admin' => ['description' => 'Allows a user to view the admin side of the task allocation page', 'title' => 'View Admin', 'group' => 'Task Allocation', 'subgroup' => 'Module'],
        'taskallocation.reaffiliation.isResponsible' => ['title'=> 'Responsible', 'description' => 'Determines if a user is responsible for a module or not', 'group' => 'Task Allocation', 'subgroup' => 'Module'],
    ];
}
