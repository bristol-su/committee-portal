<?php

namespace App\Modules\ExternalAccounts\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountClosure extends Model
{
    protected $table = 'externalaccounts_account_closures';

    protected $fillable = [
        'closed_on',
        'final_bank_statement',
        'confirmation_of_closure'
    ];

    public function finalBankStatement()
    {
        return $this->belongsTo(Document::class, 'final_bank_statement');
    }

    public function confirmationOfClosure()
    {
        return $this->belongsTo(Document::class, 'confirmation_of_closure');
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'closure_id', 'id');
    }
}
