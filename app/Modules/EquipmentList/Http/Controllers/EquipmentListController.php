<?php

namespace App\Modules\EquipmentList\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EquipmentList\Entities\Equipment;
use App\Modules\EquipmentList\Entities\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EquipmentListController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('equipmentlist.view');

        return view('equipmentlist::equipmentlist');
    }

    public function showAdminPage()
    {
        $this->authorize('equipmentlist.view-admin');

        return view('equipmentlist::admin');
    }

    public function isComplete()
    {
        $this->authorize('equipmentlist.view');

        $equipment = Equipment::where([
            'group_id' => Auth::user()->getCurrentRole()->group->id
        ])->get();

        if(Submission::where([
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'year' => getReaffiliationYear()
        ])->count() > 0) {
            return response($equipment, 200);
        }

        return response($equipment, 400);
    }

    public function createSubmission()
    {
        $this->authorize('equipmentlist.submit');

        if(Submission::create([
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'user_id' => Auth::user()->id,
            'position_id' => Auth::user()->getCurrentRole()->position->id,
            'year' => getReaffiliationYear()
        ])) {
            return response('', 200);
        }

        return response('The submission could not be saved', 500);
    }

}
