<?php
namespace App\Modules\ExecutiveSummary\Database\Seeders;

use App\Modules\BaseModule\Database\Seeders\BasePermissionAndRoleSeeder;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{
    /**
     * Roles to create
     *
     * @var array
     */
    public $roles = [

    ];

    /**
     * Permissions to create
     *
     * @var array
     */
    public $permissions = [
        'module.isVisible' => [// TODO Shouldn't affect both sides
            'title' => '#WABExecutiveSummary: Visibility of module',
            'description' => 'Is the module visible? This will effect both the admin and user side.'
        ],
        'module.isActive' => [
            'title' => '#WABExecutiveSummary: Is the module enabled?',
            'description' => 'Is the module enabled? If so, the module can be opened.'
        ],
        'view' => [
            'title' => '#WABExecutiveSummary: Viewable',
            'description' => 'Can the module page be opened?'
        ],
        'view-admin' => [
            'title' => '#WABExecutiveSummary: Viewable',
            'description' => 'Can the admin module be opened?'
        ],
        'upload' => [
            'title' => '#WABExecutiveSummary: Upload',
            'description' => 'Can the user upload a strategic plan?'
        ],
        'download' => [
            'title' => '#WABExecutiveSummary: Download',
            'description' => 'Can the user download a strategic plan belonging to their group?'
        ],
        'download-admin' => [
            'title' => '#WABExecutiveSummary: Admin Download',
            'description' => 'Can any strategic plan be downloaded?'
        ],
        'post-note' => [
            'title' => '#WABExecutiveSummary: Post a Note',
            'description' => 'Can a note be left on documents?'
        ],
        'post-note-admin' => [
            'title' => '#WABExecutiveSummary: Admin Post a Note',
            'description' => 'Can a note be left on any document?'
        ],
        'change-status' => [
            'title' => '#WABExecutiveSummary: Document Status Change',
            'description' => 'Can the user change the status of files belonging to this module?'
        ],
        'view-note-template-page' => [
            'title' => '#WABExecutiveSummary: View Note Templates Admin',
            'description' => 'Is the user able to view the note template page for the module?'
        ],
        'delete-note-template' => [
            'title' => '#WABExecutiveSummary: Delete Note Template',
            'description' => 'Can the user delete note templates for this module?'
        ],
        'update-note-template' => [
            'title' => '#WABExecutiveSummary: Update Note Template',
            'description' => 'Can this user update note templates?'
        ],
        'create-note-template' => [
            'title' => '#WABExecutiveSummary: Create Note Template',
            'description' => 'Can this user create note templates?'
        ],
        'view-note-template' => [
            'title' => '#WABExecutiveSummary: View Note Templates',
            'description' => 'Can the user utilise preset note templates?'
        ],
    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    public $assignments = [

    ];

    public $permissionPrefix = 'executivesummary.';

}