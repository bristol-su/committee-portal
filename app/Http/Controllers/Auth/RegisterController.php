<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserVerificationRequestGenerated;
use App\Http\Controllers\Controller;
use BristolSU\Support\Control\Contracts\Repositories\User as ControlUserContract;
use BristolSU\Support\DataPlatform\Contracts\Repositories\User as DataPlatformUserContract;
use BristolSU\Support\User\Contracts\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{


    use RegistersUsers;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * Register the user
     * @param Request $request
     * @param DataPlatformUserContract $dataPlatformUserRepository
     * @param ControlUserContract $controlUserRepository
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request, DataPlatformUserContract $dataPlatformUserRepository, ControlUserContract $controlUserRepository)
    {
        $request->validate([
            'identity' => ['required', 'string'],
            'password' => 'required|confirmed|min:6'
        ]);

        // Get a user from the data platform
        try {
            $dataUser = $dataPlatformUserRepository->getByIdentity($request->input('identity'));
        } catch (\Exception $e) {
            return back()
                ->withErrors(['identity' => 'Could not find your account on our website'])
                ->withInput();
        }

        // Create them on control
        $controlUser = $controlUserRepository->findOrCreateByDataId($dataUser->id());

        // Create user
        $user = $this->userRepository->create([
            'forename' => $dataUser->forename(),
            'surname' => $dataUser->surname(),
            'email' => $dataUser->email(),
            'student_id' => $dataUser->studentId(),
            'control_id' => $controlUser->id()
        ]);

        $user->password = Hash::make($request->input('password'));
        $user->save();

        event(new UserVerificationRequestGenerated($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

    }

    /**
     * Redirect the user
     *
     * @return string
     */
    public function redirectTo()
    {
        return 'portal';
    }


}
