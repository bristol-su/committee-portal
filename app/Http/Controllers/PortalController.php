<?php

namespace App\Http\Controllers;

use App\Packages\ControlDB\Models\Group;
use App\Support\Event\Event;
use App\Support\Logic\Facade\LogicTester;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

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

    public function default()
    {
        // Go to default event or show error page
        $allEvents = Event::active()->with([
            'moduleInstances',
            'forLogic',
            'adminLogic',
            'moduleInstances.activeLogic',
            'moduleInstances.visibleLogic',
            'moduleInstances.mandatoryLogic',
        ])->get();

        $events = new Collection([
            'participant' => new Collection,
            'administrator' => new Collection
        ]);

        foreach ($allEvents as $event) {
            if (LogicTester::evaluate($event->forLogic)) {
                $events['participant']->push($event);
            }

            if (LogicTester::evaluate($event->adminLogic)) {
                $events['administrator']->push($event);
            }
        }
        // TODO Tidy above and merge with view composer

        if($events['participant']->count() > 0) {
            return Response::redirectTo($events['participant']->first()->slug);
        } elseif($events['administrator']->count() > 0) {
            return Response::redirectTo($events['administrator']->first()->slug);
        }
        abort(499, 'You have no activities!');
    }

    public function admin(Event $event)
    {
        $event->load([
            'moduleInstances',
            'forLogic',
            'adminLogic',
            'moduleInstances.activeLogic',
            'moduleInstances.visibleLogic',
            'moduleInstances.mandatoryLogic',
        ]);
        if (LogicTester::evaluate($event->adminLogic)) {
            $event->module_instances = $event->moduleInstances->map(function ($moduleInstance) {
                $moduleInstance->active = true;
                $moduleInstance->visible = true;
                $moduleInstance->mandatory = false;
                return $moduleInstance;
            });
            return view('portal.portalcontent')->with(['event'=>$event, 'admin' => true]);
        }

        abort(499, 'Not found!');
    }

    public function index(Request $request, Event $event)
    {
        $event->load([
            'moduleInstances',
            'forLogic',
            'adminLogic',
            'moduleInstances.activeLogic',
            'moduleInstances.visibleLogic',
            'moduleInstances.mandatoryLogic',
        ]);
        if (LogicTester::evaluate($event->forLogic)) {
            $event->module_instances = $event->moduleInstances->map(function ($moduleInstance) {
                $moduleInstance->active = LogicTester::evaluate($moduleInstance->activeLogic);
                $moduleInstance->visible = LogicTester::evaluate($moduleInstance->visibleLogic);
                $moduleInstance->mandatory = LogicTester::evaluate($moduleInstance->mandatoryLogic);
                return $moduleInstance;
            });
            return view('portal.portalcontent')->with(['event'=>$event, 'admin' => false]);
        }
        abort(499, 'Not found!');
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