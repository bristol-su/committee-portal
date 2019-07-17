<?php

namespace App\Support\EventStore;

use App\Support\Event\Event;
use App\Support\Module\ModuleInstance\ModuleInstance;
use Illuminate\Database\Eloquent\Model;

class EventStore extends Model
{

    protected $casts = [
        'keywords' => 'array'
    ];

    protected $fillable = [
        'module_instance_id',
        'event_id',
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

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
