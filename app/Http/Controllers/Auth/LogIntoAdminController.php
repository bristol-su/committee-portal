<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Activity\Contracts\Repository as ActivityRepositoryContract;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Group as GroupRepository;
use BristolSU\Support\Control\Contracts\Repositories\Role;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use BristolSU\Support\Logic\Contracts\LogicTester;
use Illuminate\Http\Request;

class LogIntoAdminController extends Controller
{

    public function show(Request $request, Activity $activity, Authentication $authentication, RoleRepository $roleRepository, GroupRepository $groupRepository, LogicTester $logicTester)
    {
        $canActAs = ['roles' => collect(), 'groups' => collect(), 'user' => null];
        $user = $authentication->getUser();
        if($logicTester->evaluate($activity->adminLogic, $user)) {
            $canActAs['user'] = $user;
        }

        foreach ($groupRepository->allThroughUser($user) as $group) {
            if($logicTester->evaluate($activity->adminLogic, $user, $group)) {
                $canActAs['groups'][] = $group;
            }
        }

        foreach ($roleRepository->allThroughUser($user) as $role) {
            $group = $groupRepository->getById($role->group_id);
            if($logicTester->evaluate($activity->adminLogic, $user, $group, $role)) {
                $canActAs['roles'][] = $role;
            }
        }

        return view('auth.login.admin')->with([
            'act_as' => $canActAs,
            'activity' => $activity,
            'redirectTo' => $request->input('redirect')
        ]);
    }

    public function login(Request $request, Authentication $authentication, GroupRepository $groupRepository, RoleRepository $roleRepository)
    {
        if($request->input('type') === 'group') {
            $authentication->setGroup(
                $groupRepository->getById($request->input('type_id'))
            );
        } elseif($request->input('type') === 'role') {
            $authentication->setRole(
                $roleRepository->getById($request->input('type_id'))
            );
        }

        return redirect()->to($request->input('redirect', back()->getTargetUrl()));
    }

}
