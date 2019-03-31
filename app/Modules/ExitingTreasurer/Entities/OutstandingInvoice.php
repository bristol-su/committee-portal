<?php

namespace App\Modules\ExitingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;

class OutstandingInvoice extends Model
{
    protected $table = 'exitingtreasurer_outstanding_invoice';

    protected $fillable = [
        'invoice_id',
        'note'
    ];
    
    public function invoice()
    {
        return $this->belongsTo(TreasurerSignOffDocument::class,
            'invoice_id',
            'id'
        );
    }

    public function treasurerSignOffDocuments()
    {
        return $this->belongsToMany(TreasurerSignOffDocument::class,
            'exitingtreasurer_outstanding_invoices_tres_documents',
            'outstanding_invoice_id',
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
