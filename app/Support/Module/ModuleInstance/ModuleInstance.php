<?php

namespace App\Support\Module\ModuleInstance;

use App\Support\Event\Event;
use App\Support\Module\Contracts\ModuleInstance as ModuleInstanceContract;
use App\Support\Module\Registration\OverrideAttribute;
use Illuminate\Database\Eloquent\Model;

class ModuleInstance extends Model implements ModuleInstanceContract
{

    protected $fillable = [
        'alias',
        'event_id',
        'name',
        'description',
        'active',
        'visible',
        'mandatory',
        'complete'
    ];

    public function alias()
    {
        return $this->alias;
    }

    public function id()
    {
        return $this->id;
    }

    public function overrideAttribute()
    {
        return $this->hasOne(OverrideAttribute::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
