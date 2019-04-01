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
        return $this->hasMany(Correction::class);
    }

    public function missingIncomeAndExpenditure()
    {
        return $this->hasMany(MissingIncomeAndExpenditure::class);
    }

    public function outstandingInvoice()
    {
        return $this->hasMany(OutstandingInvoice::class);

    }

    public function unauthorizedExpenseClaim()
    {
        return $this->hasMany(UnauthorizedExpenseClaim::class);

    }
}
