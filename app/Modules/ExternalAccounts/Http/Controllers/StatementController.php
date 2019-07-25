<?php

namespace App\Modules\ExternalAccounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExternalAccounts\Entities\Account;
use App\Modules\ExternalAccounts\Entities\Document;
use App\Modules\ExternalAccounts\Entities\EndOfYearAccount;
use App\Modules\ExternalAccounts\Entities\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StatementController extends Controller
{
    public function create(Request $request, Account $account)
    {
        $this->authorize('externalaccounts.statement.create');

        $request->validate([
            'statements' => 'required|array',
            'statements.*' => 'mimes:bin,pdf,doc,dotm,dotx,zip,docx,pptx,ppt,odt,txt,xlsx,xls,csv,ods,otp'
        ]);

        // Save statements
        $statements = new Collection();

        foreach($request->file('statements') as $statement) {
            if ($path = Storage::cloud()->put('external-accounts-file-uploads', $statement)) {

                $statements->push(Document::create([
                    'filename' => $statement->getClientOriginalName(),
                    'mime' => $statement->getClientMimeType(),
                    'path' => $path,
                    'size' => $statement->getSize(),
                    'title' => 'Bank Account Statements for Submission '.getReaffiliationYear(),
                ]));

            } else {
                return response('Could not save final bank statement file', 500);
            }
        }

        return $statements;
    }


}
