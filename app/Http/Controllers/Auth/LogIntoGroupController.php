<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Group as GroupRepository;
use BristolSU\Support\Logic\Contracts\LogicTester;
use Illuminate\Http\Request;

class LogIntoGroupController extends Controller
{

    public function show(Request $request, Activity $activity, GroupRepository $groupRepository, Authentication $authentication)
    {
        // TODO Enable roles to be used here too.
        $user = $authentication->getUser();
        $groups = collect($groupRepository->allFromStudentControlID($authentication->getUser()->id))->filter(function($group) use ($activity, $user) {
            $logicTester = app()->make(LogicTester::class);
            return $logicTester->evaluate($activity->forLogic, $user, $group, null);
        });

        return view('auth.login.group')->with(['groups' => $groups, 'activity' => $activity, 'redirectTo' => $request->input('redirect')]);
    }

    public function login(Request $request, Authentication $authentication, GroupRepository $groupRepository)
    {
        $group = $groupRepository->getById($request->input('group_id'));
        $authentication->setGroup($group);
        return redirect()->to($request->input('redirect', back()->getTargetUrl()));
    }

}
