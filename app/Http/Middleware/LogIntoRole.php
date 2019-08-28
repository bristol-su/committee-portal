<?php

namespace App\Http\Middleware;

use App\Support\Authentication\Contracts\Authentication;
use App\Support\Control\Contracts\Repositories\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class LogIntoRole
{
    /**
     * @var Authentication
     */
    private $authentication;
    /**
     * @var Role
     */
    private $roleRepository;

    public function __construct(Authentication $authentication, Role $roleRepository)
    {
        $this->authentication = $authentication;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Handle an incoming request.
     *
     * Automatically log a user into a committee role if possible
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param Authentication $authentication
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If they have a committee role, log them in
        if ($this->authentication->getRole() === null && $this->authentication->getUser()->control_id !== null) {
            $roles = $this->roleRepository->allFromStudentControlID(
                $this->authentication->getUser()->control_id
            );
            if($roles->count() > 0) {
                $role = $roles->sortByDesc(function($role) {
                    return $role->updated_at;
                })->values()->first();
                if (!Auth::guard('role')->attempt([
                    'committee_role_id' => $role->id,
                    'student_control_id' => Auth::user()->control_id])) {
                    abort(403, 'Sorry, we were unable to log you into your committee role.');
                }
            }
        }



        return $next($request);
    }
}
