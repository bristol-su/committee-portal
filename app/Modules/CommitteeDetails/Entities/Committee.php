<?php

namespace App\Modules\CommitteeDetails\Entities;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $fillable = [
        'unioncloud_id',
        'position_control_id',
        'group_control_id',
        'year'
    ];

    protected $table = 'committeedetails_committee';

    public function isCommitteeMemberExec()
    {
        return in_array($this->position_id, config('committeedetails.executive_committee_positions'));
    }
}
