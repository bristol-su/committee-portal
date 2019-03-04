<?php

namespace App\Http\Middleware;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // If they're an admin who has access, that's fine
        if (Auth::user()->hasPermissionTo('view-as-student')) {
            abort_if(!Auth::guard('view-as-student')->check(), 403, 'Could not log you into the group');
        } // Otherwise, log into a committee role
        elseif (!Auth::guard('committee-role')->check()) {
            $student = Student::find(Auth::user()->control_id);
            $committeeRole = CommitteeRole::allThrough($student);
            abort_if($committeeRole === false || $committeeRole === null || count($committeeRole) === 0, 403, 'Couldn\'t find your committee role.');
            $committeeRole = $committeeRole->first();
            if (!Auth::guard('committee-role')->attempt([
                'committee_role_id' => $committeeRole->id,
                'student_control_id' => Auth::user()->control_id])) {
                abort(403, 'Sorry, we were unable to log you into your committee role.');
            }
        }

        return $next($request);
    }
}
