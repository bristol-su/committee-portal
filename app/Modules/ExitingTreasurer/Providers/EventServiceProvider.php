<?php


namespace App\Modules\ExitingTreasurer\Providers;

use App\Modules\ExitingTreasurer\Entities\Document;
use App\Modules\ExitingTreasurer\Entities\Submission;
use App\Modules\ExitingTreasurer\Listeners\NewIncomeExpenditureUploadRequest;
use App\Modules\ExitingTreasurer\Listeners\NewTransactionListUploadRequest;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'incomingtreasurer.training_completed' => [
            NewTransactionListUploadRequest::class,
            NewIncomeExpenditureUploadRequest::class
        ],
    ];

    public function boot() {

        Event::listen('incomingtreasurer.training_completed', function($group_id, $year) {
            // Notify the exiting treasurer warning of documents to come soon
        });

        Event::listen('exitingtreasurer.documentUploaded', function(Document $document) {
            // Notify exiting treasurer to say a document is ready for review
        });

        Event::listen('exitingtreasurer.signOffComplete', function(Submission $submission) {
            // Notify the incoming treasurer that they are now responsible (google. x2?)
        });
    }
}