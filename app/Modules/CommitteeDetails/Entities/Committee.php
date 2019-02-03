<?php

namespace App\Modules\CommitteeDetails\Entities;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $fillable = [
        ''
    ];

    protected $table = 'committeedetails_committee';

    public function isCommitteeMemberExec()
    {
        return in_array($this->position_id, config('control.executive_committee_positions'));
    }
}
