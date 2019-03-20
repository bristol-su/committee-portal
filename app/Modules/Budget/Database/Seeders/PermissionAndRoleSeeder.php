<?php
namespace App\Modules\Budget\Database\Seeders;

use App\Modules\BaseModule\Database\Seeders\BasePermissionAndRoleSeeder;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{
    public $permissionPrefix = 'budget.';

    public $permissions = [
        'module.isVisible' => [// TODO Shouldn't affect both sides
            'title' => 'Budget: Visibility of module',
            'description' => 'Is the module visible? This will effect both the admin and user side.'
        ],
        'module.isActive' => [
            'title' => 'Budget: Is the module enabled?',
            'description' => 'Is the module enabled? If so, the module can be opened.'
        ],
        'view' => [
            'title' => 'Budget: Viewable',
            'description' => 'Can the module page be opened?'
        ],
        'view-admin' => [
            'title' => 'Budget: Viewable - Admin',
            'description' => 'Can the admin module be opened?'
        ],
        'upload' => [
            'title' => 'Budget: Upload',
            'description' => 'Can the user upload a Budget?'
        ],
        'download' => [
            'title' => 'Budget: Download',
            'description' => 'Can the user download a Budget belonging to their group?'
        ],
        'download-admin' => [
            'title' => 'Budget: Admin Download',
            'description' => 'Can any Budget be downloaded?'
        ],
        'post-note' => [
            'title' => 'Budget: Post a Note',
            'description' => 'Can a note be left on documents?'
        ],
        'post-note-admin' => [
            'title' => 'Budget: Admin Post a Note',
            'description' => 'Can a note be left on any document?'
        ],
        'change-status' => [
            'title' => 'Budget: Document Status Change',
            'description' => 'Can the user change the status of files belonging to this module?'
        ],
        'view-note-template-page' => [
            'title' => 'Budget: View Note Templates Admin',
            'description' => 'Is the user able to view the note template page for the module?'
        ],
        'delete-note-template' => [
            'title' => 'Budget: Delete Note Template',
            'description' => 'Can the user delete note templates for this module?'
        ],
        'update-note-template' => [
            'title' => 'Budget: Update Note Template',
            'description' => 'Can this user update note templates?'
        ],
        'create-note-template' => [
            'title' => 'Budget: Create Note Template',
            'description' => 'Can this user create note templates?'
        ],
        'view-note-template' => [
            'title' => 'Budget: View Note Templates',
            'description' => 'Can the user utilise preset note templates?'
        ],
    ];
}