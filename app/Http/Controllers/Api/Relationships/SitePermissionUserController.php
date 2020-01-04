<?php

namespace App\Http\Controllers\Api\Relationships;

use App\Http\Controllers\Controller;
use BristolSU\ControlDB\Contracts\Models\User;
use BristolSU\ControlDB\Contracts\Repositories\User as UserRepository;
use BristolSU\Support\Permissions\Models\ModelPermission;
use BristolSU\Support\Permissions\Models\Permission;

class SitePermissionUserController extends Controller
{

    public function index(Permission $permission)
    {
        return ModelPermission::user(null, $permission->getAbility())->get();
    }

    public function store(Permission $permission, $controlUserId)
    {
        $user = app(UserRepository::class)->getById($controlUserId);
        abort_if($user === null, 404, 'User not found');

        return ModelPermission::create([
            'ability' => $permission->getAbility(),
            'model' => 'user',
            'model_id' => $user->id(),
            'result' => true
        ]);
    }

    public function delete(Permission $permission, $controlUserId)
    {
        $user = app(UserRepository::class)->getById($controlUserId);
        abort_if($user === null, 404, 'User not found');

        ModelPermission::where([
            'ability' => $permission->getAbility(),
            'model' => 'user',
            'model_id' => $user->id(),
            'result' => true
        ])->delete();
    }

}
