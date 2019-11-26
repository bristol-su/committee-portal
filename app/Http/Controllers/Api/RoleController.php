<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;

class RoleController extends Controller
{

    public function show($role, RoleRepository $roleRepository)
    {
        $role = $roleRepository->getById($role);
        $role->group = $role->group();
        $role->position = $role->position();
        return $role;
    }
}
