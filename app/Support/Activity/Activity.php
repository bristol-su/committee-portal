<?php

namespace App\Support\Activity;

use App\Support\Logic\Logic;
use App\Support\ModuleInstance\ModuleInstance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'description',
        'activity_for',
        'for_logic',
        'admin_logic',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::creating(function($model) {
            if($model->slug === null) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function moduleInstances()
    {
        return $this->hasMany(ModuleInstance::class);
    }

    public function forLogic()
    {
        return $this->belongsTo(Logic::class, 'for_logic');
    }

    public function adminLogic()
    {
        return $this->belongsTo(Logic::class, 'admin_logic');
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
