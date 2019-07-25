<?php


namespace App\Modules\ExternalAccounts\Providers;


use App\Modules\ExternalAccounts\Entities\Account;
use App\Modules\ExternalAccounts\Entities\Document;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    public function boot()
    {
        View::composer('externalaccounts::admin', function($view) {
            $submissions = \App\Modules\ExternalAccounts\Entities\Submission::with(['user'])->get();
            $submissions = $submissions->map(function($submission) {

                $submission->group = Group::find($submission->group_id)->toArray();
                $submission->position = Position::find($submission->position_id)->toArray();
                $submission->accounts = collect($submission->accounts)->map(function($account_id) {
                    return Account::with(['closure', 'endOfYearStatements', 'endOfYearStatements.statement'])->where('id', $account_id)->first()->toArray();
                })->toArray();
                $submission->statements = collect($submission->statements)->map(function($statement_id) {
                    return Document::where('id', $statement_id)->first()->toArray();
                })->toArray();
                return $submission;
            });
            $view->with('submissions', $submissions);
        });
    }

}