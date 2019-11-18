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
        return Response::redirectTo('p');

        $controlId = $userAuthentication->getUser()->control_id;
        $user = $authentication->getUser();

        if ($activityRepository->getForParticipant($user)->count() > 0) {
            return Response::redirectTo('p');

        }
        if ($activityRepository->getForAdministrator($user)->count() > 0) {
            return Response::redirectTo('a');

        }

        foreach ($roleRepository->allFromStudentControlID($controlId) as $role) {
            if ($activityRepository->getForParticipant(null, null, $role)->count() > 0) {
                return Response::redirectTo('p');

            }
            if ($activityRepository->getForAdministrator(null, null, $role)->count() > 0) {
                return Response::redirectTo('a');

            }
        }

        foreach ($groupRepository->allFromStudentControlID($controlId) as $group) {
            if ($activityRepository->getForParticipant(null, $group, null)->count() > 0) {
                return Response::redirectTo('p');

            }
            if ($activityRepository->getForAdministrator(null, $group, null)->count() > 0) {
                return Response::redirectTo('a');

            }
        }

        return Response::redirectTo('settings');
    }

    public function participant(Authentication $authentication, ActivityRepositoryContract $activityRepository, RoleRepository $roleRepository, GroupRepository $groupRepository)
    {
        $user = $authentication->getUser();
        $activities = ['role' => [], 'group' => [], 'user' => []];
        $activities['user'] = collect($activityRepository->getForParticipant($user))->filter(function($activity) {
            return $activity->activity_for !== 'group' && $activity->activity_for !== 'role';
        });

        foreach ($groupRepository->allThroughUser($user) as $group) {
            $activities['group'][$group->id] = collect($activityRepository->getForParticipant($user, $group, null))->filter(function($activity) {
                return $activity->activity_for !== 'role';
            });
        }

        foreach ($roleRepository->allThroughUser($user) as $role) {
            $group = $groupRepository->getById($role->group_id);
            $activities['role'][$role->id] = $activityRepository->getForParticipant($user, $group, $role);
        }

        return view('portal.home')->with([
            'activities' => $activities,
            'administrator' => false
        ]);
    }

    public function administrator(Authentication $authentication, ActivityRepositoryContract $activityRepository, RoleRepository $roleRepository, GroupRepository $groupRepository)
    {
        $activities = ['role' => [], 'group' => [], 'user' => []];
        $user = $authentication->getUser();
        $activities['user'] = $activityRepository->getForAdministrator($user);


        foreach ($groupRepository->allThroughUser($user) as $group) {
            $activities['group'][$group->id] = $activityRepository->getForAdministrator($user, $group, null);
        }

        foreach ($roleRepository->allThroughUser($user) as $role) {
            $group = $groupRepository->getById($role->group_id);
            $activities['role'][$role->id] = $activityRepository->getForAdministrator($user, $group, $role);
        }

        return view('portal.home')->with([
            'activities' => $activities,
            'administrator' => true
        ]);
    }

}

