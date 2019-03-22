<?php
namespace App\Modules\CommitteeDetails\Database\Seeders;

use App\Modules\BaseModule\Database\Seeders\BasePermissionAndRoleSeeder;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{

    public $permissionPrefix = 'committeedetails.';

    public $permissions = [
        'view' => [
            'title' => 'Committee Details: View',
            'description' => 'View the committee details user page'
        ],
        'add-committee-member' => [
            'title' => 'Committee Details: Add member',
            'description' => 'Add a new committee member'
        ],
        'update-committee-member' => [
            'title' => 'Committee Details: Update member',
            'description' => 'Update a committee member'
        ],
        'committeedetails.delete-committee-member' => [
            'title' => 'Committee Details: Delete member',
            'description' => 'Delete a committee member'
        ],
        'committeedetails.view-admin' => [
            'title' => 'Committee Details: View Admin',
            'description' => 'View the admin committee details user page'
        ],

    ];

}