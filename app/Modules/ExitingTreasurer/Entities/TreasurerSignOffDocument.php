<?php

namespace App\Modules\ExitingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;

class TreasurerSignOffDocument extends Model
{

    protected $table = 'exitingtreasurer_treasurer_sign_off_documents';

    protected $fillable = [
        'title',
        'filename',
        'mime',
        'path',
        'size',
    ];

    public function missingIncomeAndExpenditure()
    {
        return $this->belongsToMany(MissingIncomeAndExpenditure::class,
            'exitingtreasurer_missing_iandes_treasurer_sign_off_documents',
            'treasurer_sign_off_document_id',
            'missing_income_and_expenditure_id'
        );
    }

    public function corrections()
    {
        return $this->belongsToMany(Correction::class,
            'exitingtreasurer_corrections_treasurer_sign_off_documents',
            'treasurer_sign_off_document_id',
            'correction_id'
        );
    }

    public function outstandingInvoice()
    {
        return $this->belongsToMany(OutstandingInvoice::class,
            'exitingtreasurer_outstanding_invoices_tres_documents',
            'treasurer_sign_off_document_id',
            'outstanding_invoice_id'
        );
    }
}
