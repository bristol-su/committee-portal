<?php
namespace App\Modules\RiskAssessment\Database\Seeders;

use App\Modules\BaseModule\Database\Seeders\BasePermissionAndRoleSeeder;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{

    public $permissionPrefix = 'riskassessment.';

    public $permissions = [
        'module.isVisible' => [// TODO Shouldn't affect both sides
            'title' => 'Risk Assessment: Visibility of module',
            'description' => 'Is the module visible? This will effect both the admin and user side.'
        ],
        'module.isActive' => [
            'title' => 'Risk Assessment: Is the module enabled?',
            'description' => 'Is the module enabled? If so, the module can be opened.'
        ],
        'view' => [
            'title' => 'Risk Assessment: Viewable',
            'description' => 'Can the module page be opened?'
        ],
        'view-admin' => [
            'title' => 'Risk Assessment: Viewable - Admin',
            'description' => 'Can the admin module be opened?'
        ],
        'upload' => [
            'title' => 'Risk Assessment: Upload',
            'description' => 'Can the user upload a Risk Assessment?'
        ],
        'download' => [
            'title' => 'Risk Assessment: Download',
            'description' => 'Can the user download a Risk Assessment belonging to their group?'
        ],
        'download-admin' => [
            'title' => 'Risk Assessment: Admin Download',
            'description' => 'Can any Risk Assessment be downloaded?'
        ],
        'post-note' => [
            'title' => 'Risk Assessment: Post a Note',
            'description' => 'Can a note be left on documents?'
        ],
        'post-note-admin' => [
            'title' => 'Risk Assessment: Admin Post a Note',
            'description' => 'Can a note be left on any document?'
        ],
        'change-status' => [
            'title' => 'Risk Assessment: Document Status Change',
            'description' => 'Can the user change the status of files belonging to this module?'
        ],
        'view-note-template-page' => [
            'title' => 'Risk Assessment: View Note Templates Admin',
            'description' => 'Is the user able to view the note template page for the module?'
        ],
        'delete-note-template' => [
            'title' => 'Risk Assessment: Delete Note Template',
            'description' => 'Can the user delete note templates for this module?'
        ],
        'update-note-template' => [
            'title' => 'Risk Assessment: Update Note Template',
            'description' => 'Can this user update note templates?'
        ],
        'create-note-template' => [
            'title' => 'Risk Assessment: Create Note Template',
            'description' => 'Can this user create note templates?'
        ],
        'view-note-template' => [
            'title' => 'Risk Assessment: View Note Templates',
            'description' => 'Can the user utilise preset note templates?'
        ],
    ];






}