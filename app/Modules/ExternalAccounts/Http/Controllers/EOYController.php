<?php

namespace App\Modules\ExternalAccounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExternalAccounts\Entities\Account;
use App\Modules\ExternalAccounts\Entities\Document;
use App\Modules\ExternalAccounts\Entities\EndOfYearAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EOYController extends Controller
{
    public function create(Request $request, Account $account)
    {
        $this->authorize('externalaccounts.eoy.create');

        $request->validate([
            'statement' => 'required|mimes:bin,pdf,doc,dotm,dotx,zip,docx,pptx,ppt,odt,txt,xlsx,xls,csv,ods,otp'
        ]);

        // Save the statement
        if ($path = Storage::cloud()->put('external-accounts-file-uploads', $request->file('statement'))) {

            $statement = Document::create([
                'filename' => $request->file('statement')->getClientOriginalName(),
                'mime' => $request->file('statement')->getClientMimeType(),
                'path' => $path,
                'size' => $request->file('statement')->getSize(),
                'title' => 'Final Bank Statement for Account #'.$account->id,
            ]);

        } else {
            return response('Could not save statement file', 500);
        }


        if($eoy = EndOfYearAccount::create([
            'account_id' => $account->id,
            'statement' => $statement->id,
            'year' => getReaffiliationYear()
        ])) {
            return $account->fresh('endOfYearStatements');
        }

        return response('Could not save the end of year statement', 500);
    }

    public function get(EndOfYearAccount $endOfYearAccount)
    {
        $this->authorize('externalaccounts.eoy.create');

        abort_if($endOfYearAccount->account->group_id !== getGroupID(), 403, 'Your group does not own this account');

        return $endOfYearAccount;
    }
}
