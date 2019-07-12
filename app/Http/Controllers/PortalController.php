<?php

namespace App\Http\Controllers;

use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PortalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function guestView()
    {
        return view('portal.welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('portal.portal');
    }

    public function logIntoCommitteeRole(Request $request)
    {
        if ($request->has('committee_role_id')) {
            if (Auth::guard('committee-role')->attempt([
                'committee_role_id' => $request->input('committee_role_id'),
                'student_control_id' => Auth::user()->control_id
            ])) {
                return response('', 200);
            }
        }
        return response(401);
    }

    public function logIntoGroup(Request $request)
    {

        $this->authorize('view-as-student');

        $request->validate([
            'group_id' => 'required'
        ]);

        $group = Group::find($request->input('group_id'));

        $this->authorize('view-as-student-'.$group->getGroupType());

        if (\Auth::guard('view-as-student')->attempt([
            'group_id' => $request->input('group_id')
        ])) {
            return response('', 200);
        }
        return response('', 401);
    }

    public function logoutOfGroup()
    {
        \Auth::guard('view-as-student')->logout();

        if (!\Auth::guard('view-as-student')->check()) {
            return response('', 200);
        }
        return response('', 500);
    }
}