<?php


namespace App\Support\Filters;


use App\Support\Filters\Contracts\FilterInstance as FilterInstanceContract;
use App\Support\Logic\Logic;
use Illuminate\Database\Eloquent\Model;

class FilterInstance extends Model implements FilterInstanceContract
{

    protected $fillable = [
        'alias', 'name', 'settings'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    public function name()
    {
        return $this->name;
    }

    public function alias()
    {
        return $this->alias;
    }

    public function settings()
    {
        return $this->settings;
    }

    public function logic()
    {
        return $this->belongsTo(Logic::class);
    }


}
