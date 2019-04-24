<?php

namespace App\Modules\ExternalAccounts\Entities;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'externalaccounts_submissions';

    protected $fillable = [
        'user_id',
        'group_id',
        'position_id',
        'year',
        'conditions_met',
        'missing_functionality',
        'potential_income_lost',
        'year_end',
        'accounts',
        'statements'
    ];

    protected $casts = [
        'accounts' => 'array',
        'statements' => 'array'
    ];
}
