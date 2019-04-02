<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesWABStrategicPlan extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'wabstrategicplan.change-status' => ['description' => 'Allows a user to change the status of any document', 'title' => 'Change Document Status', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Document'],
        'wabstrategicplan.create-note-template' => ['description' => 'Allows a user to create a note template', 'title' => 'Create Note Template', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Note Template'],
        'wabstrategicplan.delete-note-template' => ['description' => 'Allows a user to delete a note template', 'title' => 'Delete Note Template', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Note Template'],
        'wabstrategicplan.download' => ['description' => 'Allows a user to download a document belonging to their group', 'title' => 'Download Document', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Document'],
        'wabstrategicplan.download-admin' => ['description' => 'Allows a user to download any document', 'title' => 'Admin: Download Documents', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Document'],
        'wabstrategicplan.module.isActive' => ['description' => 'Makes the module active (i.e. not disabled)', 'title' => 'Module Active', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Module'],
        'wabstrategicplan.module.isVisible' => ['description' => 'Makes the module visible', 'title' => 'Module Visible', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Module'],
        'wabstrategicplan.reaffiliation.isMandatory' => ['description' => 'Makes the module mandatory for reaffiliation', 'title' => 'Module Mandatory for Reaffiliation', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Module'],
        'wabstrategicplan.post-note' => ['description' => 'Allows a user to post a note on a document belonging to their group', 'title' => 'Post Note', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Note'],
        'wabstrategicplan.post-note-admin' => ['description' => 'Allows a user to post a note on any document belonging to any group', 'title' => 'Post Admin Note', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Note'],
        'wabstrategicplan.update-note-template' => ['description' => 'Allows a user to update a note template', 'title' => 'Update Note Template', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Note Template'],
        'wabstrategicplan.upload' => ['description' => 'Allows a user to upload a document', 'title' => 'Upload Document', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Document'],
        'wabstrategicplan.view' => ['description' => 'Allows a user to view the module', 'title' => 'View Documents', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Module'],
        'wabstrategicplan.view-admin' => ['description' => 'Allows a user to view the admin side of the module', 'title' => 'Admin: View Documents', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Module'],
        'wabstrategicplan.view-note-template' => ['description' => 'Allows a user to use note templates within the notes section', 'title' => 'View Note Templates', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Note Template'],
        'wabstrategicplan.view-note-template-page' => ['description' => 'Allows a user to view the note template management page', 'title' => 'View Note Template Page', 'group' => 'WeAreBristol Strategic Plan', 'subgroup' => 'Note Template'],
    ];
}
