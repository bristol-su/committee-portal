<?php


namespace App\Modules\EquipmentList\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\EquipmentList\Entities\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{

    public function create(Request $request)
    {
        $this->authorize('equipmentlist.create-equipment');

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'sometimes|string|nullable',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'bought_at' => 'required|date',
            'notes' => 'sometimes|string|nullable'
        ]);

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