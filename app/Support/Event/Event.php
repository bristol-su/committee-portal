<?php

namespace App\Support\Event;

use App\Support\Logic\Logic;
use App\Support\Module\ModuleInstance\ModuleInstance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'for',
        'for_logic',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function moduleInstances()
    {
        return $this->hasMany(ModuleInstance::class);
    }

    public function logic()
    {
        return $this->belongsTo(Logic::class, 'for_logic');
    }

    public function scopeActive(Builder $query) {
        return $query
            ->where(['start_date' => null, 'end_date'=>null])
            ->orWhere([
                ['start_date', '<=', Carbon::now()],
                ['end_date', '>=', Carbon::now()]
            ]);
    }

}
