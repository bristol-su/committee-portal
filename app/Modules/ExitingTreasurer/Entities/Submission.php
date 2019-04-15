<?php

namespace App\Modules\ExitingTreasurer\Entities;

use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'exitingtreasurer_submissions';

    protected $casts = [
        'has_missing_income_and_expenditure' => 'boolean',
        'has_outstanding_invoices' => 'boolean',
        'has_unauthorized_expense_claims' => 'boolean',
        'has_corrections' => 'boolean',
        'complete' => 'boolean'
    ];

    protected $fillable = [
        'user_id',
        'group_id',
        'position_id',
        'year',
        'has_unauthorized_expense_claims',
        'has_outstanding_invoices',
        'has_missing_income_and_expenditure',
        'has_corrections',
        'complete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        $group = Group::find($this->group_id);
        if ($group === false) {
            throw new Exception('Could not find a group (id ' . $this->id . ')');
        }
        return $group;
    }

    public function position()
    {
        if ($this->position_id === 'admin') {
            return (object)['name' => 'Administrator'];
        }
        $position = Position::find($this->position_id);
        if ($position === false) {
            throw new Exception('Could not find a position (id ' . $this->id . ')');
        }
        return $position;
    }

    public function correction()
    {
        return $this->hasOne(Correction::class);
    }

    public function missingIncomeAndExpenditure()
    {
        return $this->hasOne(MissingIncomeAndExpenditure::class);
    }

    public function outstandingInvoice()
    {
        return $this->hasMany(OutstandingInvoice::class);

    }

    public function unauthorizedExpenseClaim()
    {
        return $this->hasMany(UnauthorizedExpenseClaim::class);

    }

    public function validate()
    {
        // TODO Validate properly
        /*
         * To be valid, each bit must either be false, or have a related model
         */
        return $this->validateAnswer($this->has_unauthorized_expense_claims, $this->unauthorizedExpenseClaim->first())
            && $this->validateAnswer($this->has_outstanding_invoices, $this->outstandingInvoice->first())
            && $this->validateAnswer($this->has_missing_income_and_expenditure, $this->missingIncomeAndExpenditure)
            && $this->validateAnswer($this->has_corrections, $this->correction);

    }

    protected function validateAnswer($present, $data)
    {
        if($present === true) {
            return $data !== null;
        } elseif($present === false) {
            return true;
        }
        return false;
    }
}
