<?php

namespace App\Http\Middleware;

use BristolSU\Support\User\Contracts\UserAuthentication;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{

    /**
     * @var UserAuthentication
     */
    private $userAuthentication;

    public function __construct(UserAuthentication $userAuthentication)
    {
        $this->userAuthentication = $userAuthentication;
    }

    public function handle(Request $request, \Closure $next)
    {
        if($this->userAuthentication->getUser() === null) {
            $this->unauthenticated($request);
        }

        return $next($request);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request)
    {
        throw new AuthenticationException(
            'Unauthenticated.', [], $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(!$request->expectsJson()) {
            return '/';
        }
    }

}
