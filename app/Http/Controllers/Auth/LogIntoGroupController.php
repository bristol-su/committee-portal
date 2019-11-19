<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Authentication\Contracts\UserAuthentication;
use BristolSU\Support\Control\Contracts\Models\Group;
use BristolSU\Support\Control\Contracts\Models\Role;
use BristolSU\Support\Control\Contracts\Repositories\Group as GroupRepository;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use BristolSU\Support\Control\Contracts\Repositories\User as UserRepository;
use BristolSU\Support\Logic\Contracts\LogicTester;
use Illuminate\Http\Request;

class LogIntoGroupController extends Controller
{

    public function show(Request $request, Activity $activity, GroupRepository $groupRepository, RoleRepository $roleRepository, UserRepository $userRepository, UserAuthentication $userAuthentication)
    {
        $user = $userRepository->getById($userAuthentication->getUser()->control_id);

        $roles = collect($roleRepository->allThroughUser($user))->filter(function(Role $role) use ($activity, $user) {
            return app()->make(LogicTester::class)->evaluate($activity->forLogic, $user, $role->group(), $role);
        });

        $groups = collect($groupRepository->allThroughUser($user))->filter(function(Group $group) use ($activity, $user) {
            return app()->make(LogicTester::class)->evaluate($activity->forLogic, $user, $group);
        });

        return view('auth.login.group')->with(['groups' => $groups, 'roles' => $roles, 'activity' => $activity, 'redirectTo' => $request->input('redirect')]);
    }

    public function login(Request $request, Authentication $authentication, GroupRepository $groupRepository)
    {
        if($request->input('login_type') === 'role') {
            $role = app(RoleRepository::class)->getById($request->input('login_id'));
            $authentication->setRole($role);
        } elseif($request->input('login_type') === 'group') {
            $group = $groupRepository->getById($request->input('login_id'));
            $authentication->setGroup($group);
        }
        $authentication->setUser(app(UserRepository::class)->getById(app(UserAuthentication::class)->getUser()->control_id));

        return redirect()->to($request->input('redirect', back()->getTargetUrl()));
    }

}
