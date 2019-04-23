<?php

namespace App\Modules\ExternalAccounts\Entities;

use Illuminate\Database\Eloquent\Model;

class EndOfYearAccount extends Model
{

    protected $table = 'externalaccounts_end_of_year_accounts';

    protected $fillable = [
        'year',
        'account_id',
        'statement'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function statement()
    {
        return $this->belongsTo(Document::class, 'statement');
    }
}
