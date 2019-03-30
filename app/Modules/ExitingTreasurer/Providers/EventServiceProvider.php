<?php


namespace App\Modules\ExitingTreasurer\Providers;

use App\Modules\ExitingTreasurer\Listeners\NewIncomeExpenditureUploadRequest;
use App\Modules\ExitingTreasurer\Listeners\NewTransactionListUploadRequest;
use App\Modules\ExitingTreasurer\Listeners\NotifyExitingTreasurerOfNewFinanceDocumentToReview;
use App\Modules\ExitingTreasurer\Listeners\NotifyOutgoingTreasurerOfIncomingTreasurerTrainingComplete;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'incomingtreasurer.training_completed' => [
            NotifyOutgoingTreasurerOfIncomingTreasurerTrainingComplete::class,
            NewTransactionListUploadRequest::class,
            NewIncomeExpenditureUploadRequest::class
        ],
        'exitingtreasurer.documentUploadedForReview' => [
            NotifyExitingTreasurerOfNewFinanceDocumentToReview::class
        ]
    ];
}