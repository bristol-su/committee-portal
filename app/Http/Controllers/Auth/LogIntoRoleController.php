<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Role;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use BristolSU\Support\Logic\Facade\LogicTester;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LogIntoRoleController extends Controller
{

    public function show(Request $request, Activity $activity, RoleRepository $roleRepository, Authentication $authentication)
    {
        $roles = collect($roleRepository->allFromStudentControlID($authentication->getUser()->id))->filter(function($role) use ($activity) {
            $logicTester = app()->make(\BristolSU\Support\Logic\Contracts\LogicTester::class);
            return $logicTester->evaluate($activity->forLogic, null, null, $role);
        });

        return view('auth.login.role')->with(['roles' => $roles, 'activity' => $activity, 'redirectTo' => $request->input('redirect')]);
    }

    public function login(Request $request, Authentication $authentication, RoleRepository $roleRepository)
    {
        $role = $roleRepository->getById($request->input('role_id'));
        $authentication->setRole($role);
        return redirect()->to($request->input('redirect', back()->getTargetUrl()));
    }

}
