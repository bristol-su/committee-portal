<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogIntoRoleController extends Controller
{

    public function login(Request $request, Authentication $authentication, RoleRepository $roleRepository)
    {
        $role = $roleRepository->getById($request->input('role_id'));
        $authentication->setRole($role);
        return back();
    }

}
