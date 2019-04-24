<?php

namespace App\Modules\ExternalAccounts\Entities;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'externalaccounts_accounts';

    protected $fillable = [
        'sort_code',
        'account_number',
        'bank_name',
        'account_name',
        'purpose',
        'group_id'
    ];


    public function closure()
    {
        return $this->belongsTo(AccountClosure::class, 'closure_id', 'id');
    }

    public function endOfYearStatements()
    {
        return $this->hasMany(EndOfYearAccount::class);
    }
}
