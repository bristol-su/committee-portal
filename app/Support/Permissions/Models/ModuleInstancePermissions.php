<?php

namespace App\Support\Permissions\Models;

use App\Support\Logic\Facade\LogicTester;
use App\Support\Logic\Logic;
use App\Support\ModuleInstance\ModuleInstance;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModuleInstancePermissions extends Model
{
    protected $fillable = [
        'participant_permissions',
        'admin_permissions'
    ];

    protected $casts = [
        'participant_permissions' => 'array',
        'admin_permissions' => 'array'
    ];
}
