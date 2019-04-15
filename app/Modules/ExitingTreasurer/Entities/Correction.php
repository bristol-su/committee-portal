<?php

namespace App\Modules\ExitingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;

class Correction extends Model
{
    protected $table = 'exitingtreasurer_corrections';

    protected $fillable = [
        'note'
    ];

    public function treasurerSignOffDocuments()
    {
        return $this->belongsToMany(TreasurerSignOffDocument::class,
            'exitingtreasurer_corrections_treasurer_sign_off_documents',
            'correction_id',
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
