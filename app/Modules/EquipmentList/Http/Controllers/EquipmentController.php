<?php


namespace App\Modules\EquipmentList\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\EquipmentList\Entities\Equipment;
use App\Modules\EquipmentList\Http\Requests\CreateEquipmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{

    public function create(CreateEquipmentRequest $request)
    {
        if($equipment = Equipment::create([
            'user_id' => Auth::user()->id,
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'name' => $request->input('name'),
            'description' => $request->input('name', null),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'bought_at' => $request->input('bought_at'),
            'notes' => $request->input('notes', null)
        ])) {
            return response($equipment, 200);
        }

        return response('', 500);
    }

    public function delete(Request $request, Equipment $equipment)
    {
        $this->authorize('equipmentlist.delete-equipment');

        $request->validate([
            'deleted_reason' => 'required|string'
        ]);

        $equipment->deleted_reason = $request->input('deleted_reason');
        $equipment->save();

        if($equipment->delete()){
            return response('', 200);
        }
        return response('', 500);
    }

}