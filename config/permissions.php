<?php

use App\Support\Permissions\Testers\CheckPermissionExists;
use App\Support\Permissions\Testers\ModuleInstanceAdminPermissions;
use App\Support\Permissions\Testers\ModuleInstanceUserPermissions;
use App\Support\Permissions\Testers\SystemLogicPermission;
use App\Support\Permissions\Testers\SystemUserPermission;

return [
    'testers' => [
        SystemUserPermission::class,
        SystemLogicPermission::class,
        ModuleInstanceUserPermissions::class,
        ModuleInstanceAdminPermissions::class,
        CheckPermissionExists::class
    ]
];
