<?php

namespace App\Http\Controllers;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ControlController extends Controller
{

    protected $cacheRemember = 10000;

    public function getPositions()
    {
        return Cache::remember('App.Http.Controllers.ControlController.getPositions', $this->cacheRemember, function() {
            $position = Position::all();

            abort_if(!$position, 404, 'Position could not be found');

            return $position;
        });

    }

    public function getPosition($positionId)
    {
        return Cache::remember('App.Http.Controllers.ControlController.getPosition.'.$positionId, $this->cacheRemember, function() use ($positionId) {
            return Position::find($positionId);
        });
    }

    public function getPositionStudentGroups()
    {
        $groupID = getGroupID();

        $group = \App\Packages\ControlDB\Models\Group::find($groupID);
        return CommitteeRole::allThrough($group);

    }

    public function getAvailableCommitteeRoles()
    {
        $student = Student::find(Auth::user()->control_id);
        return CommitteeRole::allThrough($student);
    }

    public function getAllGroups()
    {
        return Group::all()->sortBy(function($group) {
            return $group->name;
        })->values();
    }
}

