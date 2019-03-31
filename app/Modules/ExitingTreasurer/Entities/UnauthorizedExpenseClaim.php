<?php

namespace App\Modules\ExitingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;

class UnauthorizedExpenseClaim extends Model
{
    protected $table = 'exitingtreasurer_unauthorized_exponse_claim';

    protected $fillable = [
        'pqu_number',
        'note'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class,
            'submission_id',
            'id');
    }


}
