<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CommitteeDetails\Entities\Committee;
use App\Packages\ControlDB\Models\CommitteeRole;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CommitteeDetailsInternalAPIController extends Controller
{
    public function getMergedGroupCommittee(Request $request)
    {
        $groupID = Auth::guard('committee-role')->user()->group->id;
        $group = \App\Packages\ControlDB\Models\Group::find($groupID);

        $merged = new Collection();

        CommitteeRole::allThrough($group)->each(function($committeeRole) use (&$merged) {
            $merged->push([
                'control_id' => $committeeRole->id,
                'unioncloud_id' => $committeeRole->student->uc_uid,
                'position_control_id' => $committeeRole->position_id,
                'group_control_id' => $committeeRole->group_id
            ]);
        });
        Committee::getGroupCommittee($groupID)->each(function($committee) use (&$merged) {
            $merged->push([
                'control_id' => $committee->control_id,
                'unioncloud_id' => $committee->unioncloud_id,
                'position_control_id' => $committee->position_control_id,
                'group_control_id' => $committee->group_control_id
            ]);
        });
        return $merged->unique(function($committee) {
            return $committee['unioncloud_id'].$committee['position_control_id'].$committee['group_control_id'].$committee['control_id'];
        });
    }

}
