<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use App\Modules\CommitteeDetails\Entities\Committee;
use App\Modules\CommitteeDetails\Rules\PositionExists;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Rules\UnionCloudUIDExists;
use Illuminate\Support\Facades\Log;

class CommitteeDetailsController extends Controller
{
    public function showUserForm()
    {
        $this->authorize('view', Committee::class);

        return view('committeedetails::committee_details');
    }

    public function addCommittee(Request $request)
    {

        $request->validate([
            'position_id' => ['required', 'integer', new PositionExists],
            'unioncloud_id' => ['required', 'integer', new UnionCloudUIDExists]
        ]);

        // Check if this position is still available

        // If the position is only allowed one committee members
        if(in_array($request->input('position_id'), config('committeedetails.single_role_available'))) {
            if( count($this->getCommittee()->where('position_control_id', $request->input('position_id'))) > 0) {
                return back()->withErrors(['position_id', 'Position has already been taken.']);
            }
        }

        $student = new Committee([
            'unioncloud_id' => $request->input('unioncloud_id'),
            'position_control_id' => $request->input('position_id'),
            'group_control_id' => Auth::guard('committee-role')->user()->group_id,
            'year' => getReaffiliationYear()
        ]);

        $this->authorize('create', $student);

        if(!$student->save()) {
            \Toast::message('Couldn\'t save the user', 'error');
        } else {
            \Toast::message('User saved', 'success');
        }

        return back();

    }

    public function deleteCommittee(Committee $committeeMember) {

        $this->authorize('delete', $committeeMember);

        if($committeeMember->delete()) {
            \Toast::message('Committee member deleted', 'success', 'Deleted');
            return back();
        }
        \Toast::message('Committee member not deleted', 'error', 'Not deleted');
        return back();
    }

    public function submitCommittee(Request $request)
    {
        $this->authorize('upload', Committee::class);
        // TODO Make this work

        // Check all required positions are filled


        dd($request);
    }

    private function getCommittee()
    {
        return Committee::where([
            'year' => getReaffiliationYear(),
            'group_control_id' => Auth::guard('committee-role')->user()->group->id
        ])->get();
    }

}
