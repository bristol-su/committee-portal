<?php

namespace App\Modules\CommitteeDetails\Entities;

use Illuminate\Database\Eloquent\Model;

class PositionSetting extends Model
{
    protected $table = 'committeedetails_position_settings';

    protected $casts = [
        'allowed_positions' => 'array',
        'required_positions' => 'array',
        'position_only_has_single_committee_member' => 'array',
        'committee_member_only_has_single_position' => 'array'
    ];

    protected $fillable = [
        'tag_reference',
        'allowed_positions',
        'required_positions',
        'position_only_has_single_committee_member',
        'committee_member_only_has_single_position' => 'array'
    ];
}
