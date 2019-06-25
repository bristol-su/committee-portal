<?php

namespace App\Support\Event;

use App\Support\Module\ModuleInstance\ModuleInstance;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'for',
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

}
