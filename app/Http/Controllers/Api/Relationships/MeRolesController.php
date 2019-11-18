<?php

namespace App\Http\Controllers\Api\Relationships;

use App\Http\Controllers\Controller;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use Illuminate\Support\Facades\Auth;

class MeRolesController extends Controller
{

    public function index(RoleRepository $roleRepository, Authentication $authentication)
    {
        return $roleRepository->allThroughUser($authentication->getUser());
    }

}
