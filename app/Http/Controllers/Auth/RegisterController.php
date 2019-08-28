<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserVerificationRequestGenerated;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UnionCloudController;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use App\Support\Control\Contracts\Repositories\User as ControlUserContract;
use App\Support\DataPlatform\Contracts\Repositories\User as DataPlatformUserContract;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{


    use RegistersUsers;

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
        $user = User::create([
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
        return '/';
    }


}
