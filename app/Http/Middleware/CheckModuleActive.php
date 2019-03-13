<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $module Module name
     * @return mixed
     */
    public function handle($request, Closure $next, $module)
    {
        /** @var User $user */
        $user = Auth::user();

        abort_if(!$user->can($module . '.module.isActive'), 403, 'This module is currently disabled. If you believe you should have access, please contact us.');

        return $next($request);
    }
}
