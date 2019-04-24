<?php

namespace App\Modules\ExternalAccounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExternalAccounts\Entities\Account;
use App\Modules\ExternalAccounts\Entities\AccountClosure;
use App\Modules\ExternalAccounts\Entities\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class ClosureController extends Controller
{
    public function create(Request $request, Account $account)
    {
        $this->authorize('externalaccounts.closure.create');

        abort_if($account->group_id !== Auth::user()->getCurrentRole()->group->id, 403, 'Your group does not own this account');

        $request->validate([
            'final_bank_statement' => 'required|mimes:bin,pdf,doc,dotm,dotx,zip,docx,pptx,ppt,odt,txt,xlsx,xls,csv,ods,otp',
            'confirmation_of_closure' => 'required|mimes:bin,pdf,doc,dotm,dotx,zip,docx,pptx,ppt,odt,txt,xlsx,xls,csv,ods,otp',
            'closed_on' => 'required|date|before_or_equal:today',
        ]);

        // Upload final bank statement and confirmation of closure
        if ($path = Storage::cloud()->put('external-accounts-file-uploads', $request->file('final_bank_statement'))) {

            $finalBankStatement = Document::create([
                'filename' => $request->file('final_bank_statement')->getClientOriginalName(),
                'mime' => $request->file('final_bank_statement')->getClientMimeType(),
                'path' => $path,
                'size' => $request->file('final_bank_statement')->getSize(),
                'title' => 'Final Bank Statement for Account #'.$account->id,
            ]);

        } else {
            return response('Could not save final bank statement file', 500);
        }

        if ($path = Storage::cloud()->put('external-accounts-file-uploads', $request->file('confirmation_of_closure'))) {

            $confirmationOfClosure = Document::create([
                'filename' => $request->file('confirmation_of_closure')->getClientOriginalName(),
                'mime' => $request->file('confirmation_of_closure')->getClientMimeType(),
                'path' => $path,
                'size' => $request->file('confirmation_of_closure')->getSize(),
                'title' => 'Confirmation of Closure for Account #'.$account->id,
            ]);


        } else {
            return response('Could not save confirmation of closure file', 500);
        }


        // Save closure and attach to account
        if(! $closure = AccountClosure::create([
            'final_bank_statement' => $finalBankStatement->id,
            'confirmation_of_closure' => $confirmationOfClosure->id,
            'closed_on' => $request->input('closed_on')
        ])) {
            return response('Could not save account closure information', 500);
        }

        $closure->account()->save($account);

        return $account->loadMissing('closure');
    }

    public function get(AccountClosure $closure)
    {
        $this->authorize('externalaccounts.closure.get');

        abort_if($closure->account->group_id !== Auth::user()->getCurrentRole()->group->id, 403, 'Your group does not own this account');

        return $closure;
    }
}
