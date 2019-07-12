<?php

namespace App\Support\Module\Module\Permissions;

use Illuminate\Database\Eloquent\Model;

class ModuleInstancePermissions extends Model
{
    protected $fillable = [
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];
}
