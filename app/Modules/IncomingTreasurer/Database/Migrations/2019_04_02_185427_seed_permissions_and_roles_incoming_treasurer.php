<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesIncomingTreasurer extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'incomingtreasurer.module.isVisible' => ['title'=> 'Module Visible', 'description' => 'Makes this module visible', 'group' => 'Incoming Treasurer', 'subgroup' => 'Module'],
        'incomingtreasurer.module.isActive' => ['title'=> 'Module Active', 'description' => 'Makes this module active', 'group' => 'Incoming Treasurer', 'subgroup' => 'Module'],
        'incomingtreasurer.reaffiliation.isMandatory' => ['title'=> 'Module Mandatory for Reaffiliation', 'description' => 'Makes this module mandatory for reaffiliation', 'group' => 'Incoming Treasurer', 'subgroup' => 'Module'],
        'incomingtreasurer.view' => ['title'=> 'View Page', 'description' => 'Allows a user to view the incoming treasurer training', 'group' => 'Incoming Treasurer', 'subgroup' => 'Module'],
        'incomingtreasurer.view-admin' => ['title'=> 'View Admin', 'description' => 'Allows a user to view the admin side of this module', 'group' => 'Incoming Treasurer', 'subgroup' => 'Module'],
        'incomingtreasurer.submit' => ['title'=> 'Submit', 'description' => 'Allows a user to submit the treasurer training form', 'group' => 'Incoming Treasurer', 'subgroup' => 'Module'],
    ];
}
