<?php

namespace App\Modules\ExitingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;

class MissingIncomeAndExpenditure extends Model
{

    protected $table = 'exitingtreasurer_missing_income_and_expenditures';

    protected $fillable = [
        'note',
        'submission_id'
    ];

    public function treasurerSignOffDocuments()
    {
        return $this->belongsToMany(TreasurerSignOffDocument::class,
            'exitingtreasurer_missing_iandes_treasurer_sign_off_documents',
            'missing_iande_id',
            'treasurer_sign_off_document_id'
        );
    }

    public function submission()
    {
        return $this->belongsTo(Submission::class,
            'submission_id',
            'id');
    }
}
