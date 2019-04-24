<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesCharitablegiving extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'charitablegiving.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'Charitable Giving', 'subgroup' => 'Module'],
        'charitablegiving.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'Charitable Giving', 'subgroup' => 'Module'],
        'charitablegiving.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'Charitable Giving', 'subgroup' => 'Module'],
        'charitablegiving.submit' => ['description' => 'Allows a user to submit the Charitable Giving form', 'title' => 'Submit', 'group' => 'Charitable Giving', 'subgroup' => 'Module'],
        'charitablegiving.view' => ['description' => 'Allows a user to view the Charitable Giving form', 'title' => 'View', 'group' => 'Charitable Giving', 'subgroup' => 'Module'],
        'charitablegiving.view-admin' => ['description' => 'Allows a user to view the admin Charitable Giving module', 'title' => 'View Admin', 'group' => 'Charitable Giving', 'subgroup' => 'Module'],
        'charitablegiving.reaffiliation.isResponsible' => ['title'=> 'Responsible', 'description' => 'Determines if a user is responsible for a module or not', 'group' => 'Charitable Giving', 'subgroup' => 'Module'],
    ];
}
