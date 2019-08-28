<?php

namespace App\Support\Logic;

use App\Support\Filters\FilterInstance;
use Illuminate\Database\Eloquent\Model;

class Logic extends Model
{
    protected $fillable = [
        'name',
        'description',
        'for',
    ];

    public function filters()
    {
        return $this->hasMany(FilterInstance::class);
    }


    public function allTrueFilters()
    {
        return $this->hasMany(FilterInstance::class)->where('filter_instances.logic_type', '=', 'all_true');
    }
    public function allFalseFilters()
    {
        return $this->hasMany(FilterInstance::class)->where('filter_instances.logic_type', '=', 'all_false');
    }
    public function anyTrueFilters()
    {
        return $this->hasMany(FilterInstance::class)->where('filter_instances.logic_type', '=', 'any_true');
    }
    public function anyFalseFilters()
    {
        return $this->hasMany(FilterInstance::class)->where('filter_instances.logic_type', '=', 'any_false');
    }
}
