<?php

namespace App\Http\Controllers;

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
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('portal');
    }

    public function logIntoCommitteeRole(Request $request)
    {
        if ($request->has('committee_role_id')) {
            if(Auth::guard('committee-role')->attempt([
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

        $request->validate([
            'group_id' => 'required'
        ]);

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

        if(!\Auth::guard('view-as-student')->check()) {
            return response('', 200);
        }
        return response('', 500);
    }
}