<?php

namespace App\Http\Middleware;

use BristolSU\Support\Authentication\Contracts\UserAuthentication;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * @var UserAuthentication
     */
    private $userAuthentication;

    public function __construct(UserAuthentication $userAuthentication)
    {
        $this->userAuthentication = $userAuthentication;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->userAuthentication->getUser() !== null) {
            return redirect()->route('portal');
        }

        return $next($request);
    }
}
