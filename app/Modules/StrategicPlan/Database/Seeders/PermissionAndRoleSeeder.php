<?php
namespace App\Modules\StrategicPlan\Database\Seeders;

use App\Modules\BaseModule\Database\Seeders\BasePermissionAndRoleSeeder;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{

    public $permissionPrefix = 'strategicplan.';

    public $permissions = [
        'module.isVisible' => [// TODO Shouldn't affect both sides
            'title' => 'Strategic Plan: Visibility of module',
            'description' => 'Is the module visible? This will effect both the admin and user side.'
        ],
        'module.isActive' => [
            'title' => 'Strategic Plan: Is the module enabled?',
            'description' => 'Is the module enabled? If so, the module can be opened.'
        ],
        'view' => [
            'title' => 'Strategic Plan: Viewable',
            'description' => 'Can the module page be opened?'
        ],
        'view-admin' => [
            'title' => 'Strategic Plan: Viewable - Admin',
            'description' => 'Can the admin module be opened?'
        ],
        'upload' => [
            'title' => 'Strategic Plan: Upload',
            'description' => 'Can the user upload a strategic plan?'
        ],
        'download' => [
            'title' => 'Strategic Plan: Download',
            'description' => 'Can the user download a strategic plan belonging to their group?'
        ],
        'download-admin' => [
            'title' => 'Strategic Plan: Admin Download',
            'description' => 'Can any strategic plan be downloaded?'
        ],
        'post-note' => [
            'title' => 'Strategic Plan: Post a Note',
            'description' => 'Can a note be left on documents?'
        ],
        'post-note-admin' => [
            'title' => 'Strategic Plan: Admin Post a Note',
            'description' => 'Can a note be left on any document?'
        ],
        'change-status' => [
            'title' => 'Strategic Plan: Document Status Change',
            'description' => 'Can the user change the status of files belonging to this module?'
        ],
        'view-note-template-page' => [
            'title' => 'Strategic Plan: View Note Templates Admin',
            'description' => 'Is the user able to view the note template page for the module?'
        ],
        'delete-note-template' => [
            'title' => 'Strategic Plan: Delete Note Template',
            'description' => 'Can the user delete note templates for this module?'
        ],
        'update-note-template' => [
            'title' => 'Strategic Plan: Update Note Template',
            'description' => 'Can this user update note templates?'
        ],
        'create-note-template' => [
            'title' => 'Strategic Plan: Create Note Template',
            'description' => 'Can this user create note templates?'
        ],
        'view-note-template' => [
            'title' => 'Strategic Plan: View Note Templates',
            'description' => 'Can the user utilise preset note templates?'
        ],
    ];
}