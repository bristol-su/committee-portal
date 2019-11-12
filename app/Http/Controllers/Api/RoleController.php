<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;

class RoleController extends Controller
{

    public function show($role, RoleRepository $roleRepository)
    {
        return $roleRepository->getById($role);
    }
}
