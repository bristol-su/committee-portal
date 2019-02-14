<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use App\Modules\CommitteeDetails\Entities\Committee;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CommitteeDetailsController extends Controller
{
    // TODO Create policy

    public function showUserForm()
    {

        $committee = $this->getCommittee();

        foreach(array_diff(config('committeedetails.executive_committee_positions'), $committee->pluck('position_control_id')->toArray()) as $position)
        {
            $committee[] = Position::find($position);
        }

        return view('committeedetails::details_submission')->with(['committee' => $committee]);
    }

    public function addCommittee(Request $request)
    {
        // TODO Validate request

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

        if(!$student->save()) {
            \Toast::message('Couldn\'t save the user', 'error');
        } else {
            \Toast::message('User saved', 'success');
        }

        return back();

    }

    public function deleteCommittee(Committee $committeeMember) {
        if($committeeMember->delete()) {
            \Toast::message('Committee member deleted', 'success', 'Deleted');
            return back();
        }
        \Toast::message('Committee member not deleted', 'error', 'Not deleted');
        return back();
    }

    public function submitCommittee(Request $request)
    {
        dd($request);
    }

    private function getCommittee()
    {
        // TODO Order by exec committee order
        return Committee::where([
            'year' => getReaffiliationYear(),
            'group_control_id' => Auth::guard('committee-role')->user()->group->id
        ])->get();
    }

}
