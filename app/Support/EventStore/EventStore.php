<?php

namespace App\Support\EventStore;

use App\Support\Activity\Activity;
use App\Support\ModuleInstance\ModuleInstance;
use Illuminate\Database\Eloquent\Model;

class EventStore extends Model
{

    protected $casts = [
        'keywords' => 'array'
    ];

    protected $fillable = [
        'module_instance_id',
        'event',
        'keywords',
        'user_id',
        'group_id',
        'role_id'
    ];

    public function moduleInstance()
    {
        return $this->belongsTo(ModuleInstance::class);
    }
}
