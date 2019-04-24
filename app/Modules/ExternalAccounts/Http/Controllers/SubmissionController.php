<?php

namespace App\Modules\ExternalAccounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExternalAccounts\Entities\Document;
use App\Modules\ExternalAccounts\Entities\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function create(Request $request)
    {
        $this->authorize('externalaccounts.submission.create');

        $request->validate([
            'conditions_met' => 'required|boolean',
            'missing_functionality' => 'sometimes|string|nullable|min:3',
            'potential_income_lost' => 'sometimes|string|nullable|min:3',
            'year_end' => 'required|date',
            'accounts' => 'required|array',
            'accounts.*' => 'integer|exists:externalaccounts_accounts,id',
            'statements' => 'required|array',
            'statements.*' => 'integer|exists:externalaccounts_documents,id'
        ]);


        if ($submission = Submission::create([
            'user_id' => Auth::user()->id,
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'position_id' => (Auth::user()->getCurrentRole()->position->id !== 'admin' ? Auth::user()->getCurrentRole()->position->id : null),
            'year' => getReaffiliationYear(),
            'conditions_met' => $request->input('conditions_met'),
            'missing_functionality' => $request->input('missing_functionality', null),
            'potential_income_lost' => $request->input('potential_income_lost', null),
            'year_end' => $request->input('year_end'),
            'accounts' => $request->input('accounts'),
            'statements' => $request->input('statements')
        ])) {
            return $submission;
        }

        return response('Could not save submission', 500);
    }

    public function get()
    {
        $this->authorize('externalaccounts.submission.get');

        // Find the most recent submission
        $submissions = Submission::where([
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'year' => getReaffiliationYear()
        ])->get();

        if($submissions->count() > 0) {
            return $submissions->first();
        }


        return response('No submissions found', 400);

    }
}
