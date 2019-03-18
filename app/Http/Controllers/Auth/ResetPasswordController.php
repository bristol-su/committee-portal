<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\ExistsInUsersTable;
use App\Rules\IsValidPassword;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


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

    /**
     * Reset the given user's password.
     *
     * Overriden to allow us to ensure the email is sent into the broker.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Changes:
        $user = User::where('email', $request->input('identity'))
            ->orWhere('student_id', $request->input('identity'))
            ->first();

        $request->merge(['email' => $user->email]);

        // End of changes

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Get the password reset validation rules.
     *
     * Updated to use identity over email
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'identity' => ['required', new ExistsInUsersTable()],
            'password' => ['required', 'confirmed', new IsValidPassword()]
        ];
    }

    /**
     * Get the response for a failed password reset.
     *
     * Updated to use identity over email
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('identity'))
            ->withErrors(['identity' => trans($response)]);
    }


}
