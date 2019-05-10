<?php

namespace App\Modules\ExternalAccounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExternalAccounts\Entities\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function create(Request $request)
    {
        $this->authorize('externalaccounts.account.create');

        $request->validate([
            'sort_code' => 'required',
            'account_number' => 'required',
            'bank_name' => 'required|string',
            'account_name' => 'required|string',
//            'purpose' => 'required|string|min:3|max:65535',
        ]);
        if($account = Account::create([
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'sort_code' => $request->input('sort_code'),
            'account_number' => $request->input('account_number'),
            'bank_name' => $request->input('bank_name'),
            'account_name' => $request->input('account_name'),
//            'purpose' => $request->input('purpose')
        ])) {
            return $account->fresh(['endOfYearStatements']);
        }

        return response('Could not create the account', 500);
    }

    public function get(Account $account)
    {
        $this->authorize('externalaccounts.account.get');

        abort_if($account->group_id !== Auth::user()->getCurrentRole()->group->id, 403, 'Your group does not own this account');

        return $account;
    }

    public function getAll()
    {
        $this->authorize('externalaccounts.account.get');

        return Account::where([
            'group_id' => Auth::user()->getCurrentRole()->group->id
        ])->with('endOfYearStatements')->get();
    }
}
