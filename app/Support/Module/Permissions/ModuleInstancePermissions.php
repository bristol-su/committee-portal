<?php

namespace App\Support\Module\Module\Permissions;

use App\Support\Logic\Facade\LogicTester;
use App\Support\Logic\Logic;
use App\Support\Module\ModuleInstance\ModuleInstance;
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

    public static function passes(User $user, $ability)
    {
        $permissions = static::parseAbility($ability);
        if($permissions === null) {
            return null;
        }
        try {
            $moduleInstance = ModuleInstance::findOrFail($permissions[0]);
        } catch(ModelNotFoundException $e) {
            return null;
        }

        if(!isset($permissions[2])) {
            try {
                $logic = Logic::findOrFail(($permissions[1] === 'admin'?$moduleInstance->event->admin_logic:$moduleInstance->event->for_logic));
            } catch (ModelNotFoundException $e) {
                return null;
            }

            return LogicTester::evaluate($logic);
        }

        if($permissions[1] === 'module') {
            if($permissions[2] === 'active') {
                return LogicTester::evaluate($moduleInstance->activeLogic);
            }
            if($permissions[2] === 'visible') {
                return LogicTester::evaluate($moduleInstance->visibleLogic);
            }
            if($permissions[2] === 'mandatory') {
                return LogicTester::evaluate($moduleInstance->mandatoryLogic);
            }
            if($permissions[2] === 'complete') {
                // TODO
                return false;
            }

            return null;
        }

        $moduleInstancePermissions = $moduleInstance->moduleInstancePermissions;
        if(!$moduleInstancePermissions) {
            return null;
        }



        $permissionLogic = $moduleInstancePermissions->{$permissions[1].'_permissions'};

        if(!array_key_exists($permissions[2], $permissionLogic)) {
            return null;
        }

        try {
            $logic = Logic::findOrFail($permissionLogic[$permissions[2]]);
        } catch (ModelNotFoundException $e) {
            return null;
        }

        return LogicTester::evaluate($logic);

    }

    public static function parseAbility($ability)
    {
        $permissions = explode('.', $ability);
        if(count($permissions) !== 2 && count($permissions) !== 3) {
            return null;
        }

        if((int)$permissions[0] === 0 || ($permissions[1] !== 'admin' && $permissions[1] !== 'participant' && $permissions[1] !== 'module')) {
            return null;
        }

        return $permissions;
    }
}
