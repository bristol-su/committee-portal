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
use BristolSU\Support\Logic\Audience\AudienceMember;
use BristolSU\Support\Logic\Contracts\LogicTester;
use Illuminate\Http\Request;

class LogIntoUserController extends Controller
{

    public function show(Request $request, Activity $activity,GroupRepository $groupRepository, RoleRepository $roleRepository, UserRepository $userRepository, UserAuthentication $userAuthentication)
    {
        $user = $userRepository->getById($userAuthentication->getUser()->control_id);
        /** @var AudienceMember $audienceMember */
        $audienceMember = app(AudienceMember::class, ['user' => $user]);

        return view('auth.login.user')->with([
            'user' => ($audienceMember->canBeUser()?$user:null),
            'groups' => $audienceMember->groups(),
            'roles' => $audienceMember->roles(),
            'activity' => $activity,
            'redirectTo' => $request->input('redirect')
        ]);
    }

    public function login(Request $request, Authentication $authentication, UserRepository $userRepository)
    {
        if($request->input('login_type') === 'role') {
            $role = app(RoleRepository::class)->getById($request->input('login_id'));
            $authentication->setRole($role);
            $authentication->setUser(app(UserRepository::class)->getById(app(UserAuthentication::class)->getUser()->control_id));
        } elseif($request->input('login_type') === 'group') {
            $group = app(GroupRepository::class)->getById($request->input('login_id'));
            $authentication->setGroup($group);
            $authentication->setUser(app(UserRepository::class)->getById(app(UserAuthentication::class)->getUser()->control_id));
        } elseif($request->input('login_type') === 'user') {
            $user = $userRepository->getById($request->input('login_id'));
            $authentication->setUser($user);
        }

        return redirect()->to($request->input('redirect', back()->getTargetUrl()));
    }

}
