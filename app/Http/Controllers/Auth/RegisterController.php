<?php

namespace App\Http\Controllers\Auth;

use ActiveResource\ConnectionManager;
use App\Events\UserVerificationRequestGenerated;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UnionCloudController;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use App\Rules\IsAValidUserByStudentIDOrEmail;
use App\Rules\IsValidPassword;
use App\Traits\GetsControlStudentByUnionCloudID;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{


    use RegistersUsers, GetsControlStudentByUnionCloudID;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register the user
     */
    public function register(Request $request)
    {

        $request->validate([
            'identity' => ['required', 'string', new IsAValidUserByStudentIDOrEmail()],
            'password' => ['required', 'confirmed', new IsValidPassword()]
        ]);

        try {
            if ($user = $this->getUser($request)) {

                event(new UserVerificationRequestGenerated($user));

                $this->guard()->login($user);
            } else {
                return back()
                    ->withErrors(['identity' => 'Error creating you on our systems. Please contact us for help!'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            return back()
                ->withErrors(['identity' => $e->getMessage()])
                ->withInput();
        }


        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

    }

    public function getUser(Request $request)
    {
        if (User::where('email', $request->input('identity'))
                ->orWhere('student_id', $request->input('identity'))
                ->count() === 0) {

            try {
                $user = $this->createUser($request);
                if (!$user) {
                    return false;
                }
            } catch (\Exception $e) {
                return false;
            }


            $user->password = Hash::make($request->input('password'));
            $user->save();

            return $user;
        }

        throw new \Exception('You have already registered', 400);
    }

    private function createUser(Request $request)
    {
        $searchTerm = $request->input('identity');
        $request->merge(['search' => $request->input('identity')]);

        $unionCloudUser = $this->getUnionCloudUser($searchTerm, $request);

        $uid = $unionCloudUser->uid;

        $controlUser = $this->getStudentByUid($uid);

        if ($controlUser !== false && $this->userHasCommitteeRole($controlUser)) {
            $user = new User([
                'forename' => $unionCloudUser->forename,
                'surname' => $unionCloudUser->surname,
                'student_id' => $unionCloudUser->id,
                'email' => $unionCloudUser->email,
                'control_id' => $controlUser->id,
            ]);

            $user->save();

            return $user;

        }

        return false;

    }


    private function userHasCommitteeRole(Student $controlUser)
    {
        return count(CommitteeRole::allThrough($controlUser)) > 0;
    }

    private function getUnionCloudUser($searchTerm, Request $request)
    {
        $unionCloudController = new UnionCloudController();

        $unionCloudUsers = json_decode($unionCloudController->searchOneTerm($request, resolve('Twigger\UnionCloud\API\UnionCloud')));
        abort_if(count($unionCloudUsers) === 0, 404, '');
        return $unionCloudUsers[0];
    }


    /**
     * Redirect the user
     *
     * @return string
     */
    public function redirectTo()
    {
        if (Auth::user()->isAdmin()) {
            return '/admin';
        } else {
            return '/portal';
        }
    }


}