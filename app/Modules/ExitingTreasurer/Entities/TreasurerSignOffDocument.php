<?php

namespace App\Modules\ExitingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

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

    public function uploadFile($document, $title)
    {
        if($this->filename === null) {

            if ($path = Storage::cloud()->put('exitingtreasurer-treasurer-sign-off', $document)) {

                $this->title = $title;
                $this->filename = $document->getClientOriginalName();
                $this->mime = $document->getClientMimeType();
                $this->path = $path;
                $this->size = $document->getSize();

                if ($this->save()) {
                    return $this;
                }

            }
        }

        return false;
    }
}
