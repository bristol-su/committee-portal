<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Authentication\Contracts\UserAuthentication;
use BristolSU\Support\Control\Contracts\Models\Role;
use BristolSU\Support\Control\Contracts\Repositories\Group as GroupRepository;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use BristolSU\Support\Control\Contracts\Repositories\User as UserRepository;
use BristolSU\Support\Logic\Contracts\LogicTester;
use Illuminate\Http\Request;

class LogIntoRoleController extends Controller
{

    /**
     * Load a view to present all possible roles a user can be acting as to access this activity.
     *
     * The activity must be a role activity, therefore we just need to show roles.
     *
     * @param Request $request
     * @param UserAuthentication $userAuthentication
     * @param Activity $activity
     * @param RoleRepository $roleRepository
     * @param GroupRepository $groupRepository
     * @param UserRepository $userRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, UserAuthentication $userAuthentication, Activity $activity, RoleRepository $roleRepository, UserRepository $userRepository)
    {
        $user = $userRepository->getById($userAuthentication->getUser()->control_id);

        $roles = collect($roleRepository->allThroughUser($user))->filter(function(Role $role) use ($activity, $user) {
            return app()->make(LogicTester::class)->evaluate($activity->forLogic, $user, $role->group(), $role);
        });

        return view('auth.login.role')->with(['roles' => $roles, 'activity' => $activity, 'redirectTo' => $request->input('redirect')]);
    }

    public function login(Request $request, Authentication $authentication, RoleRepository $roleRepository)
    {
        $role = $roleRepository->getById($request->input('role_id'));
        $authentication->setRole($role);
        $authentication->setUser(app(UserRepository::class)->getById(app(UserAuthentication::class)->getUser()->control_id));
        return redirect()->to($request->input('redirect', back()->getTargetUrl()));
    }

}
