<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Contracts\Repository as ActivityRepositoryContract;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Authentication\Contracts\UserAuthentication;
use BristolSU\Support\Control\Contracts\Repositories\Group as GroupRepository;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use BristolSU\Support\Control\Contracts\Repositories\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PortalController extends Controller
{

    public function portal(Request $request, Authentication $authentication, ActivityRepositoryContract $activityRepository, RoleRepository $roleRepository, GroupRepository $groupRepository, UserAuthentication $userAuthentication)
    {
        $controlId = $userAuthentication->getUser()->control_id;

        if($activityRepository->getForParticipant($authentication->getUser())->count() > 0) {
            return Response::redirectTo('p');

        }
        if($activityRepository->getForAdministrator($authentication->getUser())->count() > 0) {
            return Response::redirectTo('a');

        }

        foreach($roleRepository->allFromStudentControlID($controlId) as $role) {
            if($activityRepository->getForParticipant(null, null, $role)->count() > 0) {
                return Response::redirectTo('p');

            }
            if($activityRepository->getForAdministrator(null, null, $role)->count() > 0) {
                return Response::redirectTo('a');

            }
        }

        foreach($groupRepository->allFromStudentControlID($controlId) as $group) {
            if($activityRepository->getForParticipant(null, $group, null)->count() > 0) {
                return Response::redirectTo('p');

            }
            if($activityRepository->getForAdministrator(null, $group, null)->count() > 0) {
                return Response::redirectTo('a');

            }
        }

        return Response::redirectTo('settings');
    }

    public function participant(Request $request, Authentication $authentication, ActivityRepositoryContract $activityRepository, RoleRepository $roleRepository, GroupRepository $groupRepository, UserAuthentication $userAuthentication, User $userRepository)
    {
        $controlId = $userAuthentication->getUser()->control_id;
        $activities = ['role' => [], 'group' => [], 'user' => []];
        $user = $userRepository->getById($controlId);
        $activities['user'] = $activityRepository->getForParticipant($user);
        foreach($roleRepository->allFromStudentControlID($controlId) as $role) {
            $activities['role'][$role->id] = $activityRepository->getForParticipant(null, null, $role);
        }

        foreach($groupRepository->allFromStudentControlID($controlId) as $group) {
            $activities['group'][$group->id] = $activityRepository->getForParticipant(null, $group, null);
        }

        $user = $userRepository->getById($controlId);
        $activities['user'] = $activityRepository->getForParticipant($user);
        return view('portal.home')->with([
            'activities' => $activities,
            'administrator' => false
        ]);
    }

    public function administrator(Request $request, Authentication $authentication, ActivityRepositoryContract $activityRepository, RoleRepository $roleRepository, GroupRepository $groupRepository, UserAuthentication $userAuthentication, User $userRepository)
    {
        $controlId = $userAuthentication->getUser()->control_id;
        $activities = ['role' => [], 'group' => [], 'user' => []];

        foreach($roleRepository->allFromStudentControlID($controlId) as $role) {
            $activities['role'][$role->id] = $activityRepository->getForAdministrator(null, null, $role);
        }

        foreach($groupRepository->allFromStudentControlID($controlId) as $group) {
            $activities['group'][$group->id] = $activityRepository->getForAdministrator(null, $group, null);
        }

        $user = $userRepository->getById($controlId);
        $activities['user'] = $activityRepository->getForAdministrator($user);
        return view('portal.home')->with([
            'activities' => $activities,
            'administrator' => true
        ]);
    }

}

