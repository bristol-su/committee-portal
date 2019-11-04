<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Authentication\Contracts\UserAuthentication;
use BristolSU\Support\Control\Contracts\Repositories\User as UserRepository;
use BristolSU\Support\Logic\Contracts\LogicTester;
use Illuminate\Http\Request;

class LogIntoUserController extends Controller
{

    public function show(Request $request, Activity $activity, UserRepository $userRepository, UserAuthentication $userAuthentication, Authentication $authentication)
    {
        $user = $userRepository->getById($userAuthentication->getUser()->control_id);

        $authentication->setUser($user);
        return redirect()->to($request->input('redirect', back()->getTargetUrl()));

    }

    public function login(Request $request, Authentication $authentication, UserRepository $userRepository)
    {
        $user = $userRepository->getById($request->input('user_id'));
        $authentication->setUser($user);
        return redirect()->to($request->input('redirect', back()->getTargetUrl()));
    }

}
