<?php

namespace App\Support\Completion;

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
        'activity_id',
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

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
