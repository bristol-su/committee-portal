<?php


namespace App\Modules\ExitingTreasurer\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\ExitingTreasurer\Entities\Document;
use App\Packages\ControlDB\Models\Account;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UploadRequestController extends Controller
{
    public function groups() {
        return Cache::remember('App\Modules\ExitingTreasurer\Http\Controllers.groups', 400, function() {
            $groups = Group::all();
            $groups->map(function($group) {
                $accts = Account::allThrough($group);
                $group->accounts = $accts->toArray();
                return $group;
            });
            return $groups;
        });
    }

    public function createRequest(Request $request) {
        $request->validate([
            'society' => 'integer',
            'accounts' => 'array|min:1'
        ]);

        $group = Group::find($request->input('society'));
        abort_if(!$group, 500, 'Group #'.$request->input('society').' could not be found');

        $documents = [];

        foreach($request->input('accounts') as $accountId) {
            $account = Account::find($accountId);
            abort_if(!$account, 500, 'Account #'.$accountId.' could not be found');
            $title = $group->name. ' ('.$account->code.') Transaction List '.(getReaffiliationYear()-1).'/'.substr(getReaffiliationYear(), 2, 2);
            $documents[] = Document::create([
                'year' => getReaffiliationYear(),
                'title' => $title,
                'uploaded' => false,
                'type' => 'income_expenditure',
                'group_id' => $group->id
            ]);
            $documents[] = Document::create([
                'year' => getReaffiliationYear(),
                'title' => $title,
                'uploaded' => false,
                'type' => 'transaction_list',
                'group_id' => $group->id
            ]);
        }
        return $documents;
    }
}