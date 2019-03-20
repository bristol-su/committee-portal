<?php
namespace App\Modules\Constitution\Database\Seeders;

use App\Modules\BaseModule\Database\Seeders\BasePermissionAndRoleSeeder;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{
    public $permissionPrefix = 'constitution.';

    public $permissions = [
        'module.isVisible' => [// TODO Shouldn't affect both sides
            'title' => 'Constitution: Visibility of module',
            'description' => 'Is the module visible? This will effect both the admin and user side.'
        ],
        'module.isActive' => [
            'title' => 'Constitution: Is the module enabled?',
            'description' => 'Is the module enabled? If so, the module can be opened.'
        ],
        'view' => [
            'title' => 'Constitution: Viewable',
            'description' => 'Can the module page be opened?'
        ],
        'view-admin' => [
            'title' => 'Constitution: Viewable - Admin',
            'description' => 'Can the admin module be opened?'
        ],
        'upload' => [
            'title' => 'Constitution: Upload',
            'description' => 'Can the user upload a Constitution?'
        ],
        'download' => [
            'title' => 'Constitution: Download',
            'description' => 'Can the user download a Constitution belonging to their group?'
        ],
        'download-admin' => [
            'title' => 'Constitution: Admin Download',
            'description' => 'Can any Constitution be downloaded?'
        ],
        'post-note' => [
            'title' => 'Constitution: Post a Note',
            'description' => 'Can a note be left on documents?'
        ],
        'post-note-admin' => [
            'title' => 'Constitution: Admin Post a Note',
            'description' => 'Can a note be left on any document?'
        ],
        'change-status' => [
            'title' => 'Constitution: Document Status Change',
            'description' => 'Can the user change the status of files belonging to this module?'
        ],
        'view-note-template-page' => [
            'title' => 'Constitution: View Note Templates Admin',
            'description' => 'Is the user able to view the note template page for the module?'
        ],
        'delete-note-template' => [
            'title' => 'Constitution: Delete Note Template',
            'description' => 'Can the user delete note templates for this module?'
        ],
        'update-note-template' => [
            'title' => 'Constitution: Update Note Template',
            'description' => 'Can this user update note templates?'
        ],
        'create-note-template' => [
            'title' => 'Constitution: Create Note Template',
            'description' => 'Can this user create note templates?'
        ],
        'view-note-template' => [
            'title' => 'Constitution: View Note Templates',
            'description' => 'Can the user utilise preset note templates?'
        ],
    ];


}