<?php


namespace App\Modules\ExitingTreasurer\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Modules\ExitingTreasurer\Entities\UnauthorizedExpenseClaim;
use Illuminate\Http\Request;

class ExitingTreasurerExpenseClaimController extends Controller
{

    public function get(UnauthorizedExpenseClaim $claim)
    {
        $this->authorize('exitingtreasurer.get-expenseclaim');

        return $claim;
    }

    public function create(Request $request)
    {
        $this->authorize('exitingtreasurer.create-expenseclaim');

        $request->validate([
            'pqu_number' => 'required',
            'note' => 'sometimes'
        ]);

        $claim = new UnauthorizedExpenseClaim([
            'pqu_number' => $request->input('pqu_number'),
            'note' => $request->input('note'),
        ]);

        if($claim->save()) {
            return $claim;
        }

        return response('Could not create expense claim', 500);
    }

    public function delete(UnauthorizedExpenseClaim $claim)
    {
        $this->authorize('exitingtreasurer.delete-expenseclaim');

        if(!$claim->delete()){
            return response('Could not delete claim', 500);
        }
    }
}