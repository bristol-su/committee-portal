<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsAndRolesExitingTreasurer extends \App\Packages\Permissions\BasePermissionsSeederMigration
{
    public $permissions = [
        'exitingtreasurer.module.isVisible' => ['title'=> 'Module Visible', 'description' => 'Makes this module visible', 'group' => 'Exiting Treasurer', 'subgroup' => 'Module'],
        'exitingtreasurer.module.isActive' => ['title'=> 'Module Active', 'description' => 'Makes this module active', 'group' => 'Exiting Treasurer', 'subgroup' => 'Module'],
        'exitingtreasurer.reaffiliation.isMandatory' => ['title'=> 'Module Mandatory for Reaffiliation', 'description' => 'Makes this module mandatory for reaffiliation', 'group' => 'Exiting Treasurer', 'subgroup' => 'Module'],
        'exitingtreasurer.view' => ['title'=> 'View Page', 'description' => 'Allows a user to view the sign off submissions', 'group' => 'Exiting Treasurer', 'subgroup' => 'Module'],
        'exitingtreasurer.view-admin' => ['title'=> 'View Admin', 'description' => 'Alows a user to view the admin side of the module', 'group' => 'Exiting Treasurer', 'subgroup' => 'Module'],
        'exitingtreasurer.view-upload-documents' => ['title'=> 'View Document', 'description' => 'Allows a user to view any financial document (i.e. transaction list)', 'group' => 'Exiting Treasurer', 'subgroup' => 'Financial Document'],
        'exitingtreasurer.create-expenseclaim' => ['title'=> 'Create', 'description' => 'Allows a user to create an unauthorized expense claim during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Unauthorised Expense Claim'],
        'exitingtreasurer.get-expenseclaim' => ['title'=> 'Get', 'description' => 'Allows a user to get an unauthorized expense claim in a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Unauthorised Expense Claim'],
        'exitingtreasurer.delete-expenseclaim' => ['title'=> 'Delete', 'description' => 'Allows a user to delete an unauthorized expense claim during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Unauthorised Expense Claim'],
        'exitingtreasurer.create-invoice' => ['title'=> 'Create', 'description' => 'Allows a user to create an invoice during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Invoice'],
        'exitingtreasurer.get-invoice' => ['title'=> 'Get', 'description' => 'Allows a user to get an invoice in a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Invoice'],
        'exitingtreasurer.delete-invoice' => ['title'=> 'Delete', 'description' => 'Allows a user to delete an invoice during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Invoice'],
        'exitingtreasurer.get-missing-i-and-e' => ['title'=> 'Get', 'description' => 'Allows a user to get a missing income and expenditure in a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Missing I&E'],
        'exitingtreasurer.create-missing-i-and-e' => ['title'=> 'Create', 'description' => 'Allows a user to create a missing income and expenditure during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Missing I&E'],
        'exitingtreasurer.delete-missing-i-and-e' => ['title'=> 'Delete', 'description' => 'Allows a user to delete a missing income and expenditure during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Missing I&E'],
        'exitingtreasurer.get-correction' => ['title'=> 'Get', 'description' => 'Allows a user to get a correction in a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Correction'],
        'exitingtreasurer.create-correction' => ['title'=> 'Create', 'description' => 'Allows a user to create a correction during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Correction'],
        'exitingtreasurer.delete-correction' => ['title'=> 'Delete', 'description' => 'Allows a user to delete a correction during a sign off', 'group' => 'Exiting Treasurer', 'subgroup' => 'Correction'],
        'exitingtreasurer.approve' => ['title'=> 'Create', 'description' => 'Allows a user to create a new sign off on a set of documents', 'group' => 'Exiting Treasurer', 'subgroup' => 'Sign Off'],
        'exitingtreasurer.see-submissions' => ['title'=> 'View', 'description' => 'Allows a user to view any financial documents belonging to the logged in group', 'group' => 'Exiting Treasurer', 'subgroup' => 'Sign Off'],
        'exitingtreasurer.download-treasurer-document' => ['title'=> 'Download', 'description' => 'Allows a user to download a document uploaded as part of a treasurer sign off when logged in as a group', 'group' => 'Exiting Treasurer', 'subgroup' => 'Treasurer Sign Off Document'],
        'exitingtreasurer.download-report-admin' => ['title'=> 'Download Admin', 'description' => 'Allows a user to download a financial document (i.e. transaction list) from any group', 'group' => 'Exiting Treasurer', 'subgroup' => 'Financial Document'],
        'exitingtreasurer.download-report' => ['title'=> 'Download', 'description' => 'Allows a user to download a financial document (i.e. transaction list) when logged in as a group', 'group' => 'Exiting Treasurer', 'subgroup' => 'Treasurer Sign Off Document'],
        'exitingtreasurer.download-treasurer-document-admin' => ['title'=> 'Download Admin', 'description' => 'Allows a user to download a document from any group', 'group' => 'Exiting Treasurer', 'subgroup' => 'Financial Document'],
        'exitingtreasurer.post-note' => ['title'=> 'Post', 'description' => 'Allows a user to post a note on a financial document belonging to their group', 'group' => 'Exiting Treasurer', 'subgroup' => 'Note'],
        'exitingtreasurer.create-note-template' => ['title'=> 'Create', 'description' => 'Allows a user to create a new note template', 'group' => 'Exiting Treasurer', 'subgroup' => 'Note Template'],
        'exitingtreasurer.update-note-template' => ['title'=> 'Update a Role', 'description' => 'Allows a user to update a note template', 'group' => 'Exiting Treasurer', 'subgroup' => 'Note Template'],
        'exitingtreasurer.delete-note-template' => ['title'=> 'Delete', 'description' => 'Allows a user to delete a note template', 'group' => 'Exiting Treasurer', 'subgroup' => 'Note Template'],
        'exitingtreasurer.view-note-templates' => ['title'=> 'Use', 'description' => 'Allows a user to use note templates within the notes section', 'group' => 'Exiting Treasurer', 'subgroup' => 'Note Template'],
        'exitingtreasurer.post-note-admin' => ['title'=> 'Post Admin', 'description' => 'Allows a user to post a note on any financial document belonging to any group', 'group' => 'Exiting Treasurer', 'subgroup' => 'Note'],
        'exitingtreasurer.upload-document' => ['title'=> 'Upload', 'description' => 'Allows a user to upload a financial document', 'group' => 'Exiting Treasurer', 'subgroup' => 'Financial Document'],
        'exitingtreasurer.reaffiliation.isResponsible' => ['title'=> 'Responsible', 'description' => 'Determines if a user is responsible for a module or not', 'group' => 'Exiting Treasurer', 'subgroup' => 'Module'],
    ];
}
