<?php
namespace App\Modules\WABBudget\Database\Seeders;

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
            'title' => '#WABBudget: Visibility of module',
            'description' => 'Is the module visible? This will effect both the admin and user side.'
        ],
        'module.isActive' => [
            'title' => '#WAB Strategic Plan: Is the module enabled?',
            'description' => 'Is the module enabled? If so, the module can be opened.'
        ],
        'view' => [
            'title' => '#WABBudget: Viewable',
            'description' => 'Can the module page be opened?'
        ],
        'view-admin' => [
            'title' => '#WABBudget: Viewable',
            'description' => 'Can the admin module be opened?'
        ],
        'upload' => [
            'title' => '#WABBudget: Upload',
            'description' => 'Can the user upload a strategic plan?'
        ],
        'download' => [
            'title' => '#WABBudget: Download',
            'description' => 'Can the user download a strategic plan belonging to their group?'
        ],
        'download-admin' => [
            'title' => '#WABBudget: Admin Download',
            'description' => 'Can any strategic plan be downloaded?'
        ],
        'post-note' => [
            'title' => '#WABBudget: Post a Note',
            'description' => 'Can a note be left on documents?'
        ],
        'post-note-admin' => [
            'title' => '#WABBudget: Admin Post a Note',
            'description' => 'Can a note be left on any document?'
        ],
        'change-status' => [
            'title' => '#WABBudget: Document Status Change',
            'description' => 'Can the user change the status of files belonging to this module?'
        ],
        'view-note-template-page' => [
            'title' => '#WABBudget: View Note Templates Admin',
            'description' => 'Is the user able to view the note template page for the module?'
        ],
        'delete-note-template' => [
            'title' => '#WABBudget: Delete Note Template',
            'description' => 'Can the user delete note templates for this module?'
        ],
        'update-note-template' => [
            'title' => '#WABBudget: Update Note Template',
            'description' => 'Can this user update note templates?'
        ],
        'create-note-template' => [
            'title' => '#WABBudget: Create Note Template',
            'description' => 'Can this user create note templates?'
        ],
        'view-note-template' => [
            'title' => '#WABBudget: View Note Templates',
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

    public $permissionPrefix = 'wabbudget.';
}