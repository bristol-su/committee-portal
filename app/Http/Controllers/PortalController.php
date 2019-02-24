<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if (Auth::guard('committee-role')->attempt([
                'committee_role_id' => $request->input('committee_role_id'),
                'student_control_id' => Auth::user()->control_id
            ])) {
                \Toast::message('You\'re acting as ' . Auth::guard('committee-role')->user()->position->name . ' for group ' . Auth::guard('committee-role')->user()->group->name, 'success', 'Logged in');

            } else {
                \Toast::message('Couldn\'t log you in', 'error', 'Error');
            }

        }
        return redirect()->route('portal');
    }
}
