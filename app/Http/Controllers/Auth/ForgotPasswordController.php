<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\ExistsInUsersTable;
use BristolSU\Support\User\Contracts\UserRepository;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
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
        $this->userRepository = $userRepository;
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate([
            'identity' => [new ExistsInUsersTable($this->userRepository)]
        ]);

        $user = $this->userRepository->getWhereIdentity($request->input('identity'));

        $request->merge(['email' => $user->email]);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()
            ->withInput($request->only('identity'))
            ->withErrors(['identity' => trans($response)]);
    }
}
